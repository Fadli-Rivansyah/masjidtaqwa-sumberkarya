<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-link />
    {{-- css file --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>Masjid Taqwa</title>
</head>
<body >  
    {{-- navbar --}}
    <x-navbar />
    <main>
        @yield('content')
    </main>
    <footer class="container-fluid mt-4" id="footer">
        @include('_footer')
    </footer>
    <x-script />
    {{-- script public --}}
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
