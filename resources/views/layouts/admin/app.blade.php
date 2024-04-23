<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!--Navigation-->
        <header class="bg-white shadow">
            @include('layouts.admin.navigation')
        </header>

        <!-- Page Heading -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </div>
        <!--Alerts-->
        @include('layouts.admin.partials.message-updated')
        @include('layouts.admin.partials.message-deleted')
        @include('layouts.admin.partials.message-created')
        <!-- Page Content -->
        <main>
            <div class="flex flex-wrap -mx-3 mb-5">
                <div class="w-full max-w-full px-3 mb-6 mx-auto">
                    <div
                        class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                        @yield('main')
                    </div>
                </div>
            </div>
        </main>
    </div>
    @livewireScripts()
    @stack('javascript')
    <footer>
        <p>All rigths reserved &copy;</p>
    </footer>
</body>

</html>
