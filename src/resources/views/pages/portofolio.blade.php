@extends('layouts.app')

@section('content')

<section class="portfolio-page">

    <div class="container">

        <div class="page-header">

            <p class="section-label">
                Selected Projects
            </p>

            <h1>
                Discover Projects <br>
                Built for Real Problems
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

                    <a href="{{ route('portofolio.show', $portofolio->slug) }}"
                       class="portfolio-button">

                        View Project

                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection