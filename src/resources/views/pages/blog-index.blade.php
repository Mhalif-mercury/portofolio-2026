@extends('layouts.blog')

@section('content')

<div class="blog-header">
    <div class="blog-header-inner">
        <h1 class="blog-title">Muhamad Alif Mandani</h1>
        <p class="blog-subtitle">
            Web developer & UI designer. Writing about projects, architecture, and lessons learned building for the web.
        </p>
    </div>
</div>

<div class="post-list">
    <div class="post-list-inner">

        <div class="post-grid">

        @forelse($portofolios as $post)
            <article class="post-item">

                @if($post->thumbnail)
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <img
                            src="{{ asset('storage/' . $post->thumbnail) }}"
                            alt="{{ $post->title }}"
                            class="post-item-thumb"
                            loading="lazy"
                        >
                    </a>
                @endif

                <div class="post-item-body">
                    <time class="post-date" datetime="{{ $post->created_at->format('Y-m-d') }}">
                        {{ $post->created_at->format('F Y') }}
                    </time>

                    <a href="{{ route('blog.show', $post->slug) }}">
                        <h2 class="post-item-title">{{ $post->title }}</h2>
                    </a>

                    <p class="post-excerpt">{{ $post->short_description }}</p>

                    @if($post->tech_stack)
                        <div class="post-tags">
                            @foreach($post->tech_stack as $tag)
                                <span class="post-tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                    <a href="{{ route('blog.show', $post->slug) }}" class="post-cta">Read Case Study</a>
                </div>

            </article>

        @empty
            <p style="color: var(--muted); text-align: center; padding-block: 4rem; grid-column: 1 / -1;">No posts yet. Check back soon.</p>
        @endforelse

        </div>

    </div>
</div>

{{-- CONTACT --}}
<div class="contact-section" id="contact">
    <div class="contact-inner">

        <h2 class="contact-heading">Have a project in mind? Let's build something great.</h2>
        <p class="contact-text">
            Available for freelance projects, dashboard systems, and modern Laravel applications.
        </p>

        @if(session('success'))
            <div class="notification notification-success">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                    <path d="M15 4.5L6.75 12.75L3 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="notification-body">
                    <p class="notification-title">Message sent</p>
                    <p class="notification-text">{{ session('success') }}</p>
                </div>
                <button class="notification-close" onclick="dismissNotification()" aria-label="Close">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M10.5 3.5L3.5 10.5M3.5 3.5L10.5 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="notification notification-error">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" aria-hidden="true">
                    <path d="M9 6V9.75M9 12H9.008M16.5 9C16.5 13.142 13.142 16.5 9 16.5C4.858 16.5 1.5 13.142 1.5 9C1.5 4.858 4.858 1.5 9 1.5C13.142 1.5 16.5 4.858 16.5 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="notification-body">
                    <p class="notification-title">
                        {{ session('error') ? 'Something went wrong' : 'Please check the following' }}
                    </p>
                    <p class="notification-text">
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        @endif
                    </p>
                </div>
                <button class="notification-close" onclick="dismissNotification()" aria-label="Close">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M10.5 3.5L3.5 10.5M3.5 3.5L10.5 10.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="contact-form" novalidate>
            @csrf

            <div class="form-field">
                <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" required autocomplete="name">
            </div>

            <div class="form-field">
                <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="form-field">
                <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" required>
            </div>

            <div class="form-field">
                <textarea name="message" rows="5" placeholder="Tell me about your project..." required>{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="form-submit">Send Message</button>
        </form>

    </div>
</div>

@endsection
