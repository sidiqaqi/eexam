<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> {{ $title ?? config('app.name', 'Free E-Exam') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script src="{{ asset('js/momment-with-locale.min.js') }}"></script>
        <script src="{{ mix('/js/manifest.js') }}" defer></script>
        <script src="{{ mix('/js/vendor.js') }}" defer></script>
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
