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

            @foreach($portofolios as $portofolio)

                <div class="portfolio-card">

                    <img
                        src="{{ asset('storage/' . $portofolio->thumbnail) }}"
                        alt="{{ $portofolio->title }}"
                        class="portfolio-image"
                    >

                    <div class="portfolio-top">

                        <h3>
                            {{ $portofolio->title }}
                        </h3>

                        <span>
                            {{ $portofolio->year }}
                        </span>

                    </div>

                    <p>
                        {{ $portofolio->short_description }}
                    </p>

                    <div class="tags">
                        @foreach($portofolio->tech_stack as $stack)
                            <span>
                            {{ $stack }}
                            </span>
                        @endforeach
                    </div>

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