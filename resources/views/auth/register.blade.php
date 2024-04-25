@extends('layouts.customer.guest')

@section('main')
<div class="min-h-screen flex flex-col justify-center items-center bg-cover bg-center" style="background-image: url('{{ asset('storage/images/articuloEspecial.webp') }}');">
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white bg-opacity-60 shadow-lg rounded-lg backdrop-filter backdrop-blur-md">

        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="{{asset('storage/images/logo.webp') }}" alt="Logo" width="200px" height="300px" class="mx-auto rounded-full">
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Crear Cuenta</h2>
        </div>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre')"  />
                <div class="relative">
                    <x-text-input id="name" class=" block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <!-- Correo Electrónico -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Correo electrónico')" />
                <div class="relative">
                    <x-text-input id="email" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <!-- Dirección -->
            <div class="mb-4">
                <x-input-label for="address" :value="__('Dirección')" />
                <div class="relative">
                    <x-text-input id="address" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="address" :value="old('address')" required placeholder="Ej. Calle #123" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>

            <!-- Código Postal -->
            <div class="mb-4">
                <x-input-label for="postal_code" :value="__('Código Postal')" />
                <div class="relative">
                    <x-text-input id="postal_code" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="postal_code" :value="old('postal_code')" required placeholder="Ej. 47700" />
                    <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                </div>
            </div>

            <!-- Localidad -->
            <div class="mb-4">
                <x-input-label for="location" :value="__('Localidad')" />
                <div class="relative">
                    <x-text-input id="location" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="location" :value="old('location')" required placeholder="Ej. Mi localidad" />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>
            </div>

            <!-- Municipio -->
            <div class="mb-4">
                <x-input-label for="municipality" :value="__('Municipio')" />
                <div class="relative">
                    <x-text-input id="municipality" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="municipality" :value="old('municipality')" required placeholder="Ej. Mi municipio" />
                    <x-input-error :messages="$errors->get('municipality')" class="mt-2" />
                </div>
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <x-input-label for="state" :value="__('Estado')" />
                <div class="relative">
                    <x-text-input id="state" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="text" name="state" :value="old('state')" required placeholder="Ej. Jalisco" />
                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>
            </div>

            <!-- Número de teléfono -->
            <div class="mb-4">
                <x-input-label for="phone_number" :value="__('Número de celular')" />
                <div class="relative">
                    <x-text-input id="phone_number" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="tel" name="phone_number" :value="old('phone_number')" required placeholder="Ej. xxxxxxxxxx" />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <div class="relative">
                    <x-text-input id="password" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <!-- Confirmación de contraseña -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Repetir contraseña')" />
                <div class="relative">
                    <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 pr-3 border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Enlaces -->
            <div class="flex justify-between my-4">
                <x-link :href="route('login')">
                    ¿Ya tienes cuenta? Iniciar sesión.
                </x-link>
                <x-link :href="route('password.request')">
                    ¿Olvidaste tu contraseña?
                </x-link>
            </div>

            <!-- Botón de registro -->
            <x-primary-button class="w-full justify-center">
                {{ __('Crear cuenta') }}
            </x-primary-button>
        </form>
    </div>
</div>
@endsection
