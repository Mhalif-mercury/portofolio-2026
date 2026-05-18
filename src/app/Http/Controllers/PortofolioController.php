<?php

namespace App\Http\Controllers;
use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function home()
    {
        $featuredPortofolios = Portofolio::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.home', compact(
            'featuredPortofolios'
        ));
    }

    public function portfolio()
    {
        $portofolios = Portofolio::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pages.portofolio', compact(
            'portofolios'
        ));
    }

    public function show($slug)
    {
        $portofolio = Portofolio::query()
            ->with('detail')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.portofolio-detail', compact(
            'portofolio'
        ));
    }
}
