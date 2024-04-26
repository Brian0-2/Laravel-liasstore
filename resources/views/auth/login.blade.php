@extends('layouts.customer.guest')
@section('title', 'LiasStore | Iniciar Sesion')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Login') }}
</h2>
@endsection

@section('main')
<div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('storage/images/articuloEspecial.webp') }}');">
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white bg-opacity-60 shadow-lg rounded-lg backdrop-filter backdrop-blur-md">

        <!-- Logo o nombre de la aplicación -->
        <div class="text-center mb-6">
            <img src="{{asset('storage/images/logo.webp') }}" alt="Logo" width="200px" height="300px" class="mx-auto rounded-full">
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Iniciar Sesión</h2>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Correo Electrónico -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </span>
                    <x-text-input id="email" class="block mt-1 w-full pl-10" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-lock text-gray-400"></i>
                    </span>
                    <x-text-input id="password" class="block mt-1 w-full pl-10" type="password" name="password" required autocomplete="current-password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Recordarme -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Recordarme ?') }}</span>
                </label>
            </div>

            <!-- Enlaces de registro y recuperación de contraseña -->
            <div class="flex justify-between my-4">
                <x-link :href="route('register')">
                    No tienes cuenta? Crear Cuenta.
                </x-link>
                <x-link :href="route('password.request')">
                    ¿Olvidaste tu contraseña?
                </x-link>
            </div>

            <!-- Botón de inicio de sesión -->
            <x-primary-button class="w-full justify-center">
                {{ __('Iniciar Sesión') }}
            </x-primary-button>
        </form>
    </div>
</div>
@endsection
