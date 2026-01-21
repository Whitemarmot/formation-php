<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FormationController extends Controller
{
    /**
     * Display a listing of formations.
     */
    public function index(): View
    {
        $formations = Formation::active()
            ->orderByLevel()
            ->get();

        // Group formations by level
        $formationsByLevel = $formations->groupBy('level');

        // Calculate bundle price
        $bundleRegularPrice = $formations->sum('price');
        $bundlePrice = $bundleRegularPrice * 0.80; // 20% discount

        return view('formations.index', compact(
            'formations',
            'formationsByLevel',
            'bundleRegularPrice',
            'bundlePrice'
        ));
    }

    /**
     * Display the specified formation.
     */
    public function show(Formation $formation): View
    {
        // Abort if formation is not active
        if (!$formation->is_active) {
            abort(404);
        }

        // Get related formations (same level or adjacent levels)
        $relatedFormations = Formation::active()
            ->where('id', '!=', $formation->id)
            ->whereBetween('level', [$formation->level - 1, $formation->level + 1])
            ->orderByLevel()
            ->limit(3)
            ->get();

        // Check if user already owns this formation
        $userOwnsFormation = false;
        if (auth()->check()) {
            $userOwnsFormation = auth()->user()->ownsFormation($formation);
        }

        return view('formations.show', compact(
            'formation',
            'relatedFormations',
            'userOwnsFormation'
        ));
    }

    /**
     * Display formations by level.
     */
    public function byLevel(int $level): View
    {
        $levelLabels = [
            1 => 'Débutant',
            2 => 'Intermédiaire',
            3 => 'Expert',
        ];

        if (!isset($levelLabels[$level])) {
            abort(404);
        }

        $formations = Formation::active()
            ->where('level', $level)
            ->orderBy('sort_order')
            ->get();

        $levelLabel = $levelLabels[$level];

        return view('formations.level', compact('formations', 'level', 'levelLabel'));
    }
}
