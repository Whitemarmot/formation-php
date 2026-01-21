<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Download extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'formation_id',
        'token',
        'watermarked_path',
        'download_count',
        'max_downloads',
        'expires_at',
        'last_downloaded_at',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'last_downloaded_at' => 'datetime',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($download) {
            if (empty($download->token)) {
                $download->token = Str::uuid()->toString();
            }
            if (empty($download->max_downloads)) {
                $download->max_downloads = 10;
            }
            if (empty($download->expires_at)) {
                $download->expires_at = now()->addDays(
                    (int) config('formations.download_expiry_days', 7)
                );
            }
        });
    }

    /**
     * Get the user that owns the download.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order for this download.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the formation for this download.
     */
    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Check if download is still valid.
     */
    public function isValid(): bool
    {
        // Check expiration
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        // Check download limit
        if ($this->download_count >= $this->max_downloads) {
            return false;
        }

        return true;
    }

    /**
     * Check if download has expired.
     */
    public function hasExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if download limit is reached.
     */
    public function hasReachedLimit(): bool
    {
        return $this->download_count >= $this->max_downloads;
    }

    /**
     * Increment download count.
     */
    public function incrementDownloadCount(string $ipAddress = null, string $userAgent = null): void
    {
        $this->increment('download_count');
        $this->update([
            'last_downloaded_at' => now(),
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
        ]);
    }

    /**
     * Generate a signed download URL.
     */
    public function getSignedUrl(int $expiryMinutes = 60): string
    {
        return URL::temporarySignedRoute(
            'download.file',
            now()->addMinutes($expiryMinutes),
            ['token' => $this->token]
        );
    }

    /**
     * Get remaining downloads.
     */
    public function getRemainingDownloadsAttribute(): int
    {
        return max(0, $this->max_downloads - $this->download_count);
    }

    /**
     * Get days until expiration.
     */
    public function getDaysUntilExpirationAttribute(): ?int
    {
        if (!$this->expires_at) {
            return null;
        }

        return max(0, now()->diffInDays($this->expires_at, false));
    }

    /**
     * Scope a query to only include valid downloads.
     */
    public function scopeValid($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        })->whereRaw('download_count < max_downloads');
    }

    /**
     * Scope a query to only include expired downloads.
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', now());
    }
}
