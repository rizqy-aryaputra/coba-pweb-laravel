<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ request()->cookie('theme') === 'dark' ? 'dark' : '' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
        function setCookie(name, value, days = 30){
            let expires = "";
            if(days){
                const date = new Date();
                date.setTime(
                    date.getTime()
                    + (days * 24 * 60 * 60 * 1000)
                );
                expires =
                    "; expires=" + date.toUTCString();
            }
            document.cookie =
                name + "=" + value
                + expires
                + "; path=/";
        }

        function getCookie(name){
            const nameEQ = name + "=";
            const ca = document.cookie.split(';');
            for(let i = 0; i < ca.length; i++){
                let c = ca[i];
                while(c.charAt(0) === ' '){
                    c = c.substring(1, c.length);
                }
                if(c.indexOf(nameEQ) === 0){
                    return c.substring(
                        nameEQ.length,
                        c.length
                    );
                }
            }
            return null;
        }

        function deleteCookie(name){
            document.cookie =
                name +
                '=; Max-Age=-99999999;';
        }
        </script>
    </head>
    <body class="
    bg-white text-black
    dark:bg-black dark:text-white
    transition duration-300
    ">
        <div class="min-h-screen
        bg-gray-100 dark:bg-gray-900
        text-black dark:text-white
        transition duration-300">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8
                    text-black dark:text-white">
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
                @isset($slot)
                    {{ $slot }}
                @endisset

                @yield('content')
            </main>
        </div>
        <script>

        const darkToggle =
            document.getElementById('darkToggle');

        function updateThemeButton(){

            if(!darkToggle) return;

            if(
                document.documentElement
                    .classList.contains('dark')
            ){

                darkToggle.innerHTML =
                    '☀ Light';

                darkToggle.classList.remove(
                    'bg-black',
                    'text-white'
                );

                darkToggle.classList.add(
                    'bg-white',
                    'text-black'
                );

            }else{

                darkToggle.innerHTML =
                    '☾ Dark';

                darkToggle.classList.remove(
                    'bg-white',
                    'text-black'
                );

                darkToggle.classList.add(
                    'bg-black',
                    'text-white'
                );
            }

        }

        updateThemeButton();

        darkToggle?.addEventListener('click', () => {

            document.documentElement
                .classList.toggle('dark');

            if(
                document.documentElement
                    .classList.contains('dark')
            ){

                setCookie('theme', 'dark');

            }else{

                setCookie('theme', 'light');
            }

            updateThemeButton();

        });

        </script>
    </body>
</html>
