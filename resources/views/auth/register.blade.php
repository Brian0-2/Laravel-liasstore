@extends('layouts.customer.guest')
@section('main')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Correo electronico')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Direccion')" />
                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"
                    placeholder="Ej. Calle #123" required />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Postal Code -->
            <div class="mt-4">
                <x-input-label for="postal_code" :value="__('Codigo Postal')" />
                <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                    :value="old('postal_code')" placeholder="Ej. 47700" required />
                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
            </div>

            <!-- Location -->
            <div class="mt-4">
                <x-input-label for="location" :value="__('Localidad')" />
                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')"
                    placeholder="Ej. My localidad" required />
                <x-input-error :messages="$errors->get('location')" class="mt-2" />
            </div>

            <!-- Municipality -->
            <div class="mt-4">
                <x-input-label for="municipality" :value="__('Municipio')" />
                <x-text-input id="municipality" class="block mt-1 w-full" type="text" name="municipality"
                    :value="old('municipality')" placeholder="Ej. My municipio" required />
                <x-input-error :messages="$errors->get('municipality')" class="mt-2" />
            </div>

            <!-- State -->
            <div class="mt-4">
                <x-input-label for="state" :value="__('Estado')" />
                <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state')"
                    placeholder="Ej. Jalisco" required />
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>

            <!-- Phone number -->
            <div class="mt-4">
                <x-input-label for="phone_number" :value="__('Numero de celular')" />
                <x-text-input id="phone_number" class="block mt-1 w-full" type="tel" name="phone_number"
                    :value="old('phone_number')" placeholder="Ej. xxxxxxxxxx" required />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                    placeholder="Ej. XXXXXXXX" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Repetir Contraseña')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="flex justify-between my-4">
                <x-link :href="route('login')">
                    Ya tienes cuenta? Inisiar Sesion.
                </x-link>
                <x-link :href="route('password.request')">
                    ¿Olvidaste tu contraseña? Recuperar.
                </x-link>
            </div>
            <x-primary-button class="w-full justify-center">
                {{ __('Crear cuenta') }}
            </x-primary-button>
        </form>

    </div>
</div>

@endsection
