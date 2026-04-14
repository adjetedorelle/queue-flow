 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QueueFlow</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<style>
.material-symbols-outlined {
    font-variation-settings: 'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}

        body { font-family: 'Manrope', sans-serif; }
    </style>
</head>

<body class="bg-[#f8f9ff] text-[#0c1d2d]">

     {{--Sidebar--}} 
    @include('partials.sidebar')

    <div class="md:ml-64 flex flex-col min-h-screen">

         {{--Header--}} 
        @include('partials.header')

         {{--CONTENU DYNAMIQUE--}} 
        <main class="p-8 flex-1">
            {{ $slot }}
        </main>

        {{--Footer--}}  
        @include('partials.footer')

    </div>

</body>
</html> 


























{{-- <!DOCTYPE html>
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
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>  --}}
