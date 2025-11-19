<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Vallparadis')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!--Professionals-->

        <script>
            const getAssessmentUrl = "{{ route('getAssessment.professional') }}";
            const csrfToken = "{{ csrf_token() }}";
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

        <!--Professionals-->
    </head>
    <!--
    <x-bg-img/>
-->
    <body class="font-sans antialiased">
        {!! file_get_contents(resource_path('svg/icons.svg')) !!}
        <div class="min-h-screen bg-gray-100 z-10">
            @include('layouts.navigation')

            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
