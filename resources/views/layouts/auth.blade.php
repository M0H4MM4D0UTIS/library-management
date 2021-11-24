<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="/css/font.css">
    <style>body{font-family: IRANSans !important;}</style>
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="bg-gray-200 min-h-screen font-base" dir="rtl">
<div id="app">
    @include('flash-message')
    @yield('content')
</div>
</body>
</html>
