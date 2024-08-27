<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="msapplication-starturl" content="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#e5e5e5">

    <link rel="shortcut icon" href="/storage/site/favicon/favicon-16x16.png">
    <link rel="icon" sizes="192x192" type="image/png" href="/storage/site/favicon/android-chrome-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/storage/site/favicon/apple-touch-icon.png">

    <title> @isset($title){{ $title }} @else {{ config('app.name', 'Laravel') }} @endif </title>

    <meta name="author" content="Freezolar Refrigeração">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>
<style>
    body {
        background-image: url("{{ asset('img/background.jpg')}}") ;
        z-index: -1;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<body>
    <main class="py-4">
        @yield('content')
    </main>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>


