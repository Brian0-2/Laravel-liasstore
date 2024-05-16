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
            @yield('main')
        </main>
    </div>

    @livewireScripts()

    @stack('javascript')

           <!-- Pie de página fijo al final de la vista -->
           <footer class="bg-gray-800 text-white text-center w-full py-6">
            <div class="container mx-auto">
                <!-- Derechos de autor -->
                <p>&copy; {{ date('Y') }} LiasStore. Todos los derechos reservados.</p>
                <p>Contáctanos:
                    <a href="mailto:contacto@liasstore.com" class="text-blue-400 hover:underline">
                        contacto@liasstore.com
                    </a>
                </p>
                <div>
                    <a href="/politica-privacidad" class="text-blue-400 hover:underline">
                        Política de Privacidad
                    </a> |
                    <a href="/terminos-condiciones" class="text-blue-400 hover:underline">
                        Términos y Condiciones
                    </a>
                </div>
                <!-- Redes sociales -->
                <div class="mt-4">
                    <a href="https://facebook.com/liasstore" target="_blank" class="mx-2">
                        <i class="fab fa-facebook-f text-2xl text-blue-500"></i>
                    </a>
                    <a href="https://twitter.com/liasstore" target="_blank" class="mx-2">
                        <i class="fab fa-twitter text-2xl text-blue-400"></i>
                    </a>
                </div>
            </div>
        </footer>

</body>
</html>
