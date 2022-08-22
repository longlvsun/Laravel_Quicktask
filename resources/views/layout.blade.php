<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('bower_components/built-bootstrap/dist/css/bootstrap.min.css') }}" />
        @vite(['resources/js/script.js'])
    </head>
    <body class="antialiased">
        @include('header')
        @yield('content')
    </body>
</html>
