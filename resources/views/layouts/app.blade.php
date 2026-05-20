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
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->

                            @if(session('success'))

                    <div style="
                        background:#d4edda;
                        color:#155724;
                        padding:15px;
                        margin:20px;
                        border-radius:10px;
                    ">

                        {{ session('success') }}

                    </div>

                @endif


                @if(session('error'))

                    <div style="
                        background:#f8d7da;
                        color:#721c24;
                        padding:15px;
                        margin:20px;
                        border-radius:10px;
                    ">

                        {{ session('error') }}

                    </div>

                @endif
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
