@extends('layouts.app')

@section('content')

<section class="portfolio-page">

    <div class="container">

        <div class="page-header">

            <p class="section-label">
                Selected Projects
            </p>

            <h1>
                Portfolio
            </h1>

        </div>

        <div class="portfolio-grid">

            @foreach(range(1,8) as $item)

                <div class="portfolio-card">

                    <div class="portfolio-image"></div>

                    <div class="portfolio-top">

                        <h3>
                            Nokoribite
                        </h3>

                        <span>
                            2026
                        </span>

                    </div>

                    <p>
                        Marketplace website for near-expired food
                        with dynamic discount pricing.
                    </p>

                    <div class="tags">

                        <span>Laravel</span>
                        <span>Filament</span>
                        <span>Livewire</span>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection