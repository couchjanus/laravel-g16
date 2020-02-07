<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}  - @yield('title')</title>
    
    <!-- Include Styles -->
    @include('layouts.partials.shared._styles')
    
    {{-- Head --}}
    @yield('styles')
    @yield('meta')
</head>
<body class=@yield('body_class')>
    @yield('page')
    
    <!-- Include Scripts -->
    @include('layouts.partials.shared._scripts')
    @stack('scripts')
</body>
</html>
