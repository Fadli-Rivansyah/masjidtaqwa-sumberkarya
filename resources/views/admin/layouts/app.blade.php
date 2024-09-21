<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <x-link />
    <title>{{ $title }}</title>
   {{-- css file --}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    @include('admin.partials.navbar')
    <main>
        @yield('content')
    </main>
    <x-script />
    @if(isset($chart))
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    @endif
</body>
</html>