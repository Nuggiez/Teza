<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <style>
        @font-face {
            font-family: 'TF2';
            src: url('{{ asset('fonts/tf2.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
    </style>

    <!-- Styles -->
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="bg-[#2C2A2A] font-tf2 text-[#FF9D00] min-h-screen flex flex-col">
    {{ $navbar ?? view('layouts.inc.navbar') }}

    <hr class="h-1 bg-[#FF9D00] border-0">

    @yield('admin')

    <main class="flex-1 py-4 px-4 max-w-7xl w-full mx-auto">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('info'))
            <div class="bg-blue-500 text-white p-4 mb-4">
                {{ session('info') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-500 text-white p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif
        <div class='border-2 border-[var(--color-border)]'>
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    {{ $footer ?? view('components.footer') }}
</body>

</html>
