<?php

namespace Database\Seeders;

use App\Models\Portofolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portofolio::create([
            'title' => 'Nokoribite',
            'slug' => 'nokoribite',
            'thumbnail' => 'portofolio/nokoribite.jpg',

            'short_description' =>
                'Marketplace website for near-expired food with dynamic discount pricing.',

            'github_url' =>
                'https://github.com/mhalif/nokoribite',

            'live_url' =>
                'https://nokoribite.com',

            'tech_stack' => [
                'Laravel',
                'Filament',
                'Livewire',
                'MariaDB',
                'Docker',
            ],

            'year' => 2026,

            'is_featured' => true,
            'is_active' => true,
        ]);

        Portofolio::create([
            'title' => 'RT/RW Net Billing System',
            'slug' => 'rt-rw-net-billing-system',
            'thumbnail' => 'portofolio/billing.jpg',

            'short_description' =>
                'E-billing system for RT/RW Net providers with automated invoice and payment management.',

            'github_url' =>
                'https://github.com/mhalif/billing-system',

            'live_url' =>
                null,

            'tech_stack' => [
                'Laravel',
                'Filament',
                'Midtrans',
                'Livewire',
            ],

            'year' => 2025,

            'is_featured' => true,
            'is_active' => true,
        ]);

        Portofolio::create([
            'title' => 'Personal Developer Portfolio',
            'slug' => 'personal-developer-portfolio',
            'thumbnail' => 'portofolio/portfolio.jpg',

            'short_description' =>
                'Modern minimalist developer portfolio inspired by premium digital studio websites.',

            'github_url' =>
                'https://github.com/mhalif/portfolio',

            'live_url' =>
                null,

            'tech_stack' => [
                'Laravel',
                'Blade',
                'CSS',
            ],

            'year' => 2026,

            'is_featured' => true,
            'is_active' => true,
        ]);
    }
}
