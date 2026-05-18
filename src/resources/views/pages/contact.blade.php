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

            <a href="mailto:your@email.com"
               class="button-outline">

                Contact Me

            </a>

            @if(session('success'))

                <div class="success-message"
                    id="successMessage">

                    {{ session('success') }}

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
                           required>

                </div>

                <div class="form-group">

                    <input type="email"
                           name="email"
                           placeholder="Your Email"
                           required>

                </div>

                <div class="form-group">

                    <input type="text"
                           name="subject"
                           placeholder="Subject"
                           required>

                </div>

                <div class="form-group">

                    <textarea name="message"
                              rows="6"
                              placeholder="Tell me about your project..."
                              required></textarea>

                </div>

                <button type="submit"
                        class="button-outline-contact">

                    Send Message

                </button>

            </form>

        </div>

    </div>

</section>

<script>

    setTimeout(() => {

        const message = document.getElementById('successMessage');

        if (message) {

            message.style.opacity = '0';

            message.style.transform = 'translateY(-10px)';

            setTimeout(() => {

                message.remove();

            }, 300);

        }

    }, 3000);

</script>

@endsection