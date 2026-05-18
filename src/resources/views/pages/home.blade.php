@extends('layouts.app')

@section('content')

<section class="hero">

    <div class="container">

        <div class="hero-content">

            <p class="hero-label">
                Web Developer • UI/UX Designer
            </p>

            <h1>
                Building clean and modern digital experiences.
            </h1>

            <p class="hero-description">
                I create scalable web applications using Figma, Laravel,
                Filament, Livewire, and modern web technologies.
            </p>

        </div>

    </div>

</section>

<section class="portfolio-preview">

    <div class="container">

        <div class="section-header">

            <div>
                <p class="section-label">
                    Selected Works
                </p>

                <h2>
                    Portfolio
                </h2>
            </div>

            <a href="{{ route('portfolio') }}" class="button-outline">
                View All
            </a>

        </div>

        <div class="portfolio-grid">

            @foreach(range(1,4) as $item)

                <div class="portfolio-card">

                    <div class="portfolio-image"></div>

                    <h3>
                        Nokoribite Marketplace
                    </h3>

                    <p>
                        Marketplace platform for near-expired food using Laravel,
                        Filament v3, and Midtrans integration.
                    </p>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection