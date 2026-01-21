<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    /**
     * Download a formation PDF.
     */
    public function download(Request $request, string $token): StreamedResponse
    {
        $download = Download::where('token', $token)
            ->with('formation')
            ->firstOrFail();

        // Check if download is valid
        if (!$download->isValid()) {
            if ($download->hasExpired()) {
                abort(410, 'Ce lien de téléchargement a expiré.');
            }

            if ($download->hasReachedLimit()) {
                abort(403, 'Vous avez atteint le nombre maximum de téléchargements pour cette formation.');
            }

            abort(403, 'Ce lien de téléchargement n\'est plus valide.');
        }

        // Get the watermarked PDF path
        $path = $download->watermarked_path;

        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Le fichier PDF n\'est pas disponible.');
        }

        // Increment download count
        $download->incrementDownloadCount(
            $request->ip(),
            $request->userAgent()
        );

        // Generate filename
        $filename = sprintf(
            '%s - %s.pdf',
            $download->formation->name,
            $download->order->order_number
        );

        // Stream the file
        return Storage::disk('local')->download($path, $filename, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Display user's downloads.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $downloads = Download::where('user_id', $user->id)
            ->with(['formation', 'order'])
            ->orderByDesc('created_at')
            ->get();

        // Group by order
        $downloadsByOrder = $downloads->groupBy('order_id');

        return view('account.downloads', compact('downloads', 'downloadsByOrder'));
    }

    /**
     * Regenerate a download link.
     */
    public function regenerate(Request $request, Download $download)
    {
        // Verify user owns this download
        if ($request->user()->id !== $download->user_id) {
            abort(403);
        }

        // Extend expiration
        $download->update([
            'expires_at' => now()->addDays((int) config('formations.download_expiry_days', 7)),
        ]);

        return back()->with('success', 'Le lien de téléchargement a été régénéré.');
    }
}
