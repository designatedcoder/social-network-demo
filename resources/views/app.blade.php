<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}" type="image/x-icon">

        <title>{{ config('app.name', 'Social Network') }}</title>

        <!-- Fonts -->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-primary antialiased">
        @inertia
    </body>
</html>
