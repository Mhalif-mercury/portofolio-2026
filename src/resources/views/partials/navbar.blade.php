<nav class="navbar">

    <div class="container navbar-wrapper">

        <a href="/" class="logo">
            <img src="{{ asset('assets/images/Group 2.svg') }}"
         alt="Logo">
        </a>

        <div class="nav-links">

            <a href="{{ route('home') }}">
                Home
            </a>

            <a href="{{ route('portfolio') }}">
                Portfolio
            </a>

            <a href="{{ route('contact') }}">
                Contact
            </a>

        </div>

    </div>

</nav>