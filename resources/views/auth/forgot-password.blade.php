@extends('layouts.customer.guest')
@section('main')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('¿Olvidaste tu contraseña? Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.
                    ') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo electronico')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex justify-between my-4">
                <x-link :href="route('login')">
                    Ya tienes cuenta? Inisiar Sesion.
                </x-link>
                <x-link :href="route('register')">
                    No tienes cuenta? Crear Cuenta.
                </x-link>
            </div>
            <x-primary-button class="w-full justify-center">
                {{ __('Enviar instrucciones') }}
            </x-primary-button>
        </form>
    </div>
</div>
@endsection
