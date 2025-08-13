<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <div
        x-data="{ show: false, message: '', color: '' }"
        x-init="
            @if(session('success'))
                message = '{{ session('success') }}';
                color = 'green';
                show = true;
                setTimeout(() => show = false, 3000);
            @elseif(session('error'))
                message = '{{ session('error') }}';
                color = 'red';
                show = true;
                setTimeout(() => show = false, 3000);
            @endif
        "
        x-show="show"
        x-transition
        class="fixed top-5 right-5 px-4 py-2 rounded text-white shadow-lg"
        :class="color === 'green' ? 'bg-green-600' : 'bg-red-600'"
        style="display: none;"
    >
        <span x-text="message"></span>
    </div>

</html>
