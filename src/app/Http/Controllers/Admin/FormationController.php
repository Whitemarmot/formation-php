<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FormationController extends Controller
{
    /**
     * Display a listing of formations.
     */
    public function index(): View
    {
        $formations = Formation::withTrashed()
            ->withCount(['orderItems as sales_count' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->where('status', 'completed');
                });
            }])
            ->orderBy('level')
            ->orderBy('sort_order')
            ->get();

        return view('admin.formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new formation.
     */
    public function create(): View
    {
        return view('admin.formations.create');
    }

    /**
     * Store a newly created formation.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'level' => 'required|integer|min:1|max:3',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'page_count' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'table_of_contents' => 'nullable|json',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:51200',
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Ensure unique slug
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Formation::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter++;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('formations/covers', 'public');
        }

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_path'] = $request->file('pdf_file')
                ->store('formations/pdfs', 'local');
        }

        // Parse table of contents
        if (isset($validated['table_of_contents'])) {
            $validated['table_of_contents'] = json_decode($validated['table_of_contents'], true);
        }

        $formation = Formation::create($validated);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation créée avec succès.');
    }

    /**
     * Display the specified formation.
     */
    public function show(Formation $formation): View
    {
        $formation->loadCount(['orderItems as sales_count' => function ($query) {
            $query->whereHas('order', function ($q) {
                $q->where('status', 'completed');
            });
        }]);

        $recentSales = $formation->orderItems()
            ->with(['order.user'])
            ->whereHas('order', function ($q) {
                $q->where('status', 'completed');
            })
            ->latest()
            ->limit(20)
            ->get();

        return view('admin.formations.show', compact('formation', 'recentSales'));
    }

    /**
     * Show the form for editing the specified formation.
     */
    public function edit(Formation $formation): View
    {
        return view('admin.formations.edit', compact('formation'));
    }

    /**
     * Update the specified formation.
     */
    public function update(Request $request, Formation $formation): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'level' => 'required|integer|min:1|max:3',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'page_count' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'table_of_contents' => 'nullable|json',
            'cover_image' => 'nullable|image|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:51200',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')
                ->store('formations/covers', 'public');
        }

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            $validated['pdf_path'] = $request->file('pdf_file')
                ->store('formations/pdfs', 'local');
        }

        // Parse table of contents
        if (isset($validated['table_of_contents'])) {
            $validated['table_of_contents'] = json_decode($validated['table_of_contents'], true);
        }

        // Handle boolean fields
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $formation->update($validated);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation mise à jour avec succès.');
    }

    /**
     * Remove the specified formation (soft delete).
     */
    public function destroy(Formation $formation): RedirectResponse
    {
        $formation->delete();

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }

    /**
     * Restore a soft-deleted formation.
     */
    public function restore(int $id): RedirectResponse
    {
        $formation = Formation::withTrashed()->findOrFail($id);
        $formation->restore();

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation restaurée avec succès.');
    }

    /**
     * Toggle formation active status.
     */
    public function toggleActive(Formation $formation): RedirectResponse
    {
        $formation->update(['is_active' => !$formation->is_active]);

        $status = $formation->is_active ? 'activée' : 'désactivée';

        return back()->with('success', "Formation {$status} avec succès.");
    }
}
