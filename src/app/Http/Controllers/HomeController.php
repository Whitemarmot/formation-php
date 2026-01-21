<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index(): View
    {
        $formations = Formation::active()
            ->orderByLevel()
            ->get();

        $featuredFormations = Formation::active()
            ->featured()
            ->orderByLevel()
            ->get();

        // Calculate bundle price
        $bundleRegularPrice = $formations->sum('price');
        $bundlePrice = $bundleRegularPrice * 0.80; // 20% discount

        return view('pages.home', compact(
            'formations',
            'featuredFormations',
            'bundleRegularPrice',
            'bundlePrice'
        ));
    }

    /**
     * Display the about/trainer page.
     */
    public function formateur(): View
    {
        return view('pages.formateur');
    }

    /**
     * Display the contact page.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Display the legal notices page.
     */
    public function mentionsLegales(): View
    {
        return view('pages.mentions-legales');
    }

    /**
     * Display the terms and conditions page.
     */
    public function cgv(): View
    {
        return view('pages.cgv');
    }

    /**
     * Display the privacy policy page.
     */
    public function confidentialite(): View
    {
        return view('pages.confidentialite');
    }
}
