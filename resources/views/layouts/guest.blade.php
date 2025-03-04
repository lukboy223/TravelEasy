<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#E7F3FC]">
            {{-- website logo --}}
            <div>
                <a href="/">
                    <img src="\img\traveleasy_logo.png" class="h-10" alt="TravelEasy Logo" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        {{-- footer  --}}
        <section>
            <div class="bg-[#FFF7E8] border-t-[#1E1358] border-t-[0.5em] p-12 grid grid-cols-2 gap-4 text-black text-sm py-16">
                <div class="m-auto w-3/4">
                    <h4>Adres: Skyway 123, Amsterdam, Nederland</h4>
                    <h4>Telefoon: +31 20 123 4567</h4>
                    <h4>E-mail: contact@traveleasy.com</h4>
                    <h4>Openingstijden: Ma - Vr: 08:00 - 18:00 | Za - Zo: 09:00 - 16:00</h4>
                </div>

                <div class="m-auto w-3/4">
                    <h4>Volg ons op sociale media:</h4>
                    <h4>Facebook: facebook.com/traveleasy</h4>
                    <h4>Instagram: instagram.com/traveleasy</h4>
                    <h4>x: x.com/traveleasy</h4>
                </div>
            </div>
        </section>
    </body>
</html>
