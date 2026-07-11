<?php

namespace App\Http\Controllers;
use App\Models\Portofolio;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::query()
            ->where('is_active', true)
            ->latest()
            ->get();

        return view('pages.blog-index', compact('portofolios'));
    }

    public function show($slug)
    {
        $post = Portofolio::query()
            ->with('detail')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.blog-show', compact('post'));
    }
}
