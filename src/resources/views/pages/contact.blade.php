@extends('layouts.app')

@section('content')

<section class="contact-page">

    <div class="container">

        <div class="contact-content">

            {{-- HERO SECTION --}}
            <p class="section-label">
                Let's Work Together
            </p>

            <h1>
                Have a project in mind?
                Let's build something great together.
            </h1>

            <p class="contact-description">
                Available for freelance projects,
                dashboard systems, and modern Laravel applications.
            </p>

            {{-- SUCCESS NOTIFICATION --}}
            @if(session('success'))
                <div class="notification-card notification-success" id="notification">
                    <div class="notification-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M16.6667 5L7.5 14.1667L3.33333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="notification-body">
                        <span class="notification-title">Message Sent!</span>
                        <span class="notification-text">{{ session('success') }}</span>
                    </div>
                    <button class="notification-close" onclick="dismissNotification()">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- ERROR NOTIFICATION (rate limit / server error) --}}
            @if(session('error'))
                <div class="notification-card notification-error" id="notification">
                    <div class="notification-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 6.66667V10.8333M10 13.3333H10.0083M18.3333 10C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39763 18.3333 1.66667 14.6024 1.66667 10C1.66667 5.39763 5.39763 1.66667 10 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="notification-body">
                        <span class="notification-title">Oops!</span>
                        <span class="notification-text">{{ session('error') }}</span>
                    </div>
                    <button class="notification-close" onclick="dismissNotification()">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
                <div class="notification-card notification-error" id="validationErrors">
                    <div class="notification-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 6.66667V10.8333M10 13.3333H10.0083M18.3333 10C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39763 18.3333 1.66667 14.6024 1.66667 10C1.66667 5.39763 5.39763 1.66667 10 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="notification-body">
                        <span class="notification-title">Please check the following:</span>
                        <span class="notification-text">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </span>
                    </div>
                    <button class="notification-close" onclick="dismissNotification()">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- CONTACT FORM --}}
            <form action="{{ route('contact.store') }}"
                  method="POST"
                  class="contact-form">

                @csrf

                <div class="form-group">

                    <input type="text"
                           name="name"
                           placeholder="Your Name"
                           value="{{ old('name') }}"
                           required>

                </div>

                <div class="form-group">

                    <input type="email"
                           name="email"
                           placeholder="Your Email"
                           value="{{ old('email') }}"
                           required>

                </div>

                <div class="form-group">

                    <input type="text"
                           name="subject"
                           placeholder="Subject"
                           value="{{ old('subject') }}"
                           required>

                </div>

                <div class="form-group">

                    <textarea name="message"
                              rows="6"
                              placeholder="Tell me about your project..."
                              required>{{ old('message') }}</textarea>

                </div>

                <button type="submit"
                        class="portfolio-button">

                    Send Message

                </button>

            </form>

        </div>

    </div>

</section>

<script>

    function dismissNotification() {
        const notification = document.querySelector('.notification-card');
        if (notification) {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => { notification.remove(); }, 400);
        }
    }

    @if(session('success') || session('error') || $errors->any())
    setTimeout(() => {
        const el = document.getElementById('notification') || document.getElementById('validationErrors');
        if (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateX(100%)';
            setTimeout(() => { el.remove(); }, 400);
        }
    }, 6000);
    @endif

</script>

@endsection