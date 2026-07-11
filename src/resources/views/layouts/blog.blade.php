<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Muhamad Alif Mandani — Blog' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <nav class="nav">
        <div class="nav-inner">
            <a href="{{ route('blog.index') }}" class="nav-logo">MHALIF</a>
            <div class="nav-links">
                <a href="{{ route('blog.index') }}">Blog</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-inner">
            <span>&copy; {{ date('Y') }} MHALIF</span>
            <a href="{{ route('blog.index') }}">Blog</a>
            <a href="mailto:alifmandani14@gmail.com">Email</a>
        </div>
    </footer>

    <script>
    function dismissNotification() {
        var el = document.querySelector('.notification');
        if (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(-0.5rem)';
            setTimeout(function() { el.remove(); }, 300);
        }
    }

    var notifications = document.querySelectorAll('.notification');
    notifications.forEach(function(el) {
        setTimeout(function() {
            el.style.opacity = '0';
            el.style.transform = 'translateY(-0.5rem)';
            setTimeout(function() { el.remove(); }, 300);
        }, 6000);
    });
    </script>

</body>
</html>
