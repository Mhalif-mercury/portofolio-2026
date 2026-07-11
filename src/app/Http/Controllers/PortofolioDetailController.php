<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;

class PortofolioDetailController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pages.portofolio', compact('portofolios'));
    }

    public function show($slug)
    {
        $portofolio = Portofolio::query()
            ->with('detail')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.portofolio-detail', compact('portofolio'));
    }
}
