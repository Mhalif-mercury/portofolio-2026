@extends('layouts.app')

@section('content')

<section class="portofolio-detail-page">

    <div class="container">

        {{-- HERO SECTION --}}
        <div class="detail-hero">

            <p class="section-label">
                Project Case Study
            </p>

            <h1>
                {{ $portofolio->title }}
            </h1>

            <p class="detail-description">
                {{ $portofolio->short_description }}
            </p>

            <div class="detail-tags">

                @foreach($portofolio->tech_stack as $stack)

                    <span>
                        {{ $stack }}
                    </span>

                @endforeach

            </div>

            <div class="detail-actions">

                @if($portofolio->github_url)

                    <a href="{{ $portofolio->github_url }}"
                       target="_blank"
                       class="button-outline">

                        View Github

                    </a>

                @endif

                @if($portofolio->live_url)

                    <a href="{{ $portofolio->live_url }}"
                       target="_blank"
                       class="button-outline">

                        Live Preview

                    </a>

                @endif

            </div>

        </div>

        {{-- THUMBNAIL --}}
        @if($portofolio->thumbnail)

            <img
                src="{{ asset('storage/' . $portofolio->thumbnail) }}"
                alt="{{ $portofolio->title }}"
                class="detail-thumbnail"
            >

        @endif

        {{-- CONTENT --}}
        @if($portofolio->detail)

            <div class="detail-content">

                {{-- PROJECT DESCRIPTION --}}
                <div class="detail-section">

                    <p class="detail-label">
                        Project Overview
                    </p>

                    <h2>
                        Judul Project & Deskripsi Singkat
                    </h2>

                    <div class="detail-text">
                        {!! $portofolio->detail->project_description !!}
                    </div>

                </div>

                {{-- PROBLEM ANALYSIS --}}
                <div class="detail-section">

                    <p class="detail-label">
                        System Analysis
                    </p>

                    <h2>
                        Analisis Masalah & Kebutuhan Sistem
                    </h2>

                    <div class="detail-text">
                        {!! $portofolio->detail->problem_analysis !!}
                    </div>

                </div>

                {{-- ARCHITECTURE --}}
                <div class="detail-section">

                    <p class="detail-label">
                        Architecture
                    </p>

                    <h2>
                        Arsitektur & Tech Stack
                    </h2>

                    <div class="detail-text">
                        {!! $portofolio->detail->architecture_explanation !!}
                    </div>

                </div>

                {{-- TECH STACK --}}
                <div class="detail-section">

                    <p class="detail-label">
                        Technology
                    </p>

                    <h2>
                        Penjelasan Teknologi
                    </h2>

                    <div class="detail-text">
                        {!! $portofolio->detail->tech_stack_explanation !!}
                    </div>

                </div>

                {{-- ERD --}}
                @if($portofolio->detail->erd_image)

                    <div class="detail-section">

                        <p class="detail-label">
                            Database Design
                        </p>

                        <h2>
                            Entity Relationship Diagram
                        </h2>

                        <img
                            src="{{ asset('storage/' . $portofolio->detail->erd_image) }}"
                            alt="ERD"
                            class="detail-diagram"
                        >

                    </div>

                @endif

                {{-- FLOWCHART --}}
                @if($portofolio->detail->flowchart_image)

                    <div class="detail-section">

                        <p class="detail-label">
                            System Flow
                        </p>

                        <h2>
                            Flowchart Sistem
                        </h2>

                        <img
                            src="{{ asset('storage/' . $portofolio->detail->flowchart_image) }}"
                            alt="Flowchart"
                            class="detail-diagram"
                        >

                    </div>

                @endif

                {{-- CONCLUSION --}}
                @if($portofolio->detail->conclusion)

                    <div class="detail-section">

                        <p class="detail-label">
                            Conclusion
                        </p>

                        <h2>
                            Kesimpulan
                        </h2>

                        <div class="detail-text">
                            {!! $portofolio->detail->conclusion !!}
                        </div>

                    </div>

                @endif

            </div>

        @endif

    </div>

</section>

@endsection