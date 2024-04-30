@extends('layouts.admin.app')

@section('title')
    Administrador | Crear Proveedor
@endsection

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center space-x-2">
        <i class="fa-solid fa-plus text-black"></i>
        <i class="fa-solid fa-truck-fast text-black"></i>
        <span class="hover:text-indigo-700 transition-colors duration-300">
            {{ __('Crear Proveedor') }}
        </span>
    </h2>
@endsection

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <x-link :href="route('providers.index')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-md transition-colors duration-300">
                    Volver
                </x-link>

                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('providers.store') }}" novalidate>
                        @csrf

                        <p class="text-xl font-semibold mb-4">Datos personales</p>

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="store_name" :value="__('Nombre de la tienda')" />
                            <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('store_name')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('store_name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="nickname" :value="__('Sub Nombre')" />
                            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('nickname')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
                        </div>

                        <p class="text-xl font-semibold mb-4">Dirección</p>

                        <div class="mb-4">
                            <x-input-label for="address" :value="__('Dirección')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('address')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <!-- Código postal, localidad, municipio, estado, teléfono -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <x-input-label for="postal_code" :value="__('Código postal')" />
                                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    :value="old('postal_code')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="location" :value="__('Localidad')" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    :value="old('location')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="municipality" :value="__('Municipio')" />
                                <x-text-input id="municipality" name="municipality" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    :value="old('municipality')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('municipality')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="state" :value="__('Estado')" />
                                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    :value="old('state')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('state')" />
                            </div>

                            <div class="mb-4">
                                <x-input-label for="phone_number" :value="__('Número de teléfono')" />
                                <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    :value="old('phone_number')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                            </div>
                        </div>

                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-md">{{ __('Crear') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
