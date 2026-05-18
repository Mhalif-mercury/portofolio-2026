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
                    Portofolio
                </h2>
            </div>

            <a href="{{ route('portfolio') }}" class="button-outline">
                View All
            </a>

        </div>

        <div class="portfolio-grid">

            @foreach($featuredPortofolios as $portofolio)

            
                <div class="portfolio-card">

                    <img src="{{ asset('storage/' . $portofolio->thumbnail) }}" class="portfolio-image" alt="{{ $portofolio->title }}">

                    <h3>
                        {{ $portofolio->title }}
                    </h3>

                    <p>
                        {{ $portofolio->short_description }}
                    </p>

                    @if($portofolio->github_url)
    
                        <a href="{{ route('portofolio.show', $portofolio->slug) }}"
                        target="_blank"
                        class="portfolio-button">
    
                            View Project
    
                        </a>
    
                    @endif
                </div>


            @endforeach

        </div>

        

    </div>

</section>

@endsection