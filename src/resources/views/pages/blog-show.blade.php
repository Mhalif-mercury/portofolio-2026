@extends('layouts.blog')

@section('content')

<article class="article">
    <div class="article-inner">

        <a href="{{ route('blog.index') }}" class="article-back">
            &larr; All Posts
        </a>

        <header class="article-header">
            <time class="article-date" datetime="{{ $post->created_at->format('Y-m-d') }}">
                {{ $post->created_at->format('F j, Y') }}
            </time>

            <h1 class="article-title">{{ $post->title }}</h1>

            <p class="article-excerpt">{{ $post->short_description }}</p>

            @if($post->tech_stack)
                <div class="article-tags">
                    @foreach($post->tech_stack as $tag)
                        <span class="article-tag">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </header>

        @if($post->thumbnail)
            <img
                src="{{ asset('storage/' . $post->thumbnail) }}"
                alt="{{ $post->title }}"
                class="article-thumbnail"
            >
        @endif

        @if($post->github_url || $post->live_url)
            <div class="article-links">
                @if($post->github_url)
                    <a href="{{ $post->github_url }}" target="_blank" rel="noopener" class="article-link">
                        View on GitHub &rarr;
                    </a>
                @endif
                @if($post->live_url)
                    <a href="{{ $post->live_url }}" target="_blank" rel="noopener" class="article-link">
                        Live Preview &rarr;
                    </a>
                @endif
            </div>
        @endif

        @if($post->detail)
            <div class="article-body">

                @if($post->detail->project_description)
                    <section>
                        <h2>Project Overview</h2>
                        {!! $post->detail->project_description !!}
                    </section>
                @endif

                @if($post->detail->problem_analysis)
                    <section>
                        <h2>Problem Analysis</h2>
                        {!! $post->detail->problem_analysis !!}
                    </section>
                @endif

                @if($post->detail->architecture_explanation)
                    <section>
                        <h2>Architecture & Tech Stack</h2>
                        {!! $post->detail->architecture_explanation !!}
                    </section>
                @endif

                @if($post->detail->tech_stack_explanation)
                    <section>
                        <h2>Technology Decisions</h2>
                        {!! $post->detail->tech_stack_explanation !!}
                    </section>
                @endif

                @if($post->detail->erd_image)
                    <section>
                        <h2>Database Design</h2>
                        <figure>
                            <img
                                src="{{ asset('storage/' . $post->detail->erd_image) }}"
                                alt="Entity Relationship Diagram"
                                loading="lazy"
                            >
                        </figure>
                    </section>
                @endif

                @if($post->detail->flowchart_image)
                    <section>
                        <h2>System Flow</h2>
                        <figure>
                            <img
                                src="{{ asset('storage/' . $post->detail->flowchart_image) }}"
                                alt="System Flowchart"
                                loading="lazy"
                            >
                        </figure>
                    </section>
                @endif

                @if($post->detail->conclusion)
                    <section>
                        <h2>Conclusion</h2>
                        {!! $post->detail->conclusion !!}
                    </section>
                @endif

            </div>
        @endif

    </div>
</article>

@endsection
