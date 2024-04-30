@extends('layouts.admin.app')

@section('title')
    Administrador | Editar Usuarios
@endsection

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center space-x-2">
        <i class="fa-solid fa-pen-to-square text-indigo-600"></i>
        <i class="fa-solid fa-user text-indigo-600"></i>
        <span class="hover:text-indigo-700 transition-colors duration-300">
            {{ __('Editar Usuario') }}
        </span>
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('users.index')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-md transition-colors duration-300">
            Volver
        </x-link>

        <div class="bg-white shadow-lg rounded-lg p-6 mt-4">
            <form method="POST" action="{{ route('users.update', $user->id) }}" novalidate>
                @csrf
                @method('PUT')

                <p class="text-xl font-semibold mb-4">Datos personales</p>

                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nombre')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Correo')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        :value="old('email', $user->email)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <p class="text-xl font-semibold mb-4">Dirección</p>

                <div class="mb-4">
                    <x-input-label for="address" :value="__('Dirección')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                        :value="old('address', $user->address)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>

                <!-- Código postal, localidad, municipio, estado, teléfono -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <x-input-label for="postal_code" :value="__('Código postal')" />
                        <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            :value="old('postal_code', $user->postal_code)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Localidad')" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            :value="old('location', $user->location)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="municipality" :value="__('Municipio')" />
                        <x-text-input id="municipality" name="municipality" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            :value="old('municipality', $user->municipality)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('municipality')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="state" :value="__('Estado')" />
                        <x-text-input id="state" name="state" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            :value="old('state', $user->state)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('state')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="phone_number" :value="__('Teléfono')" />
                        <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            :value="old('phone_number', $user->phone_number)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                    </div>
                </div>

                <p class="text-xl font-semibold mb-4">Roles</p>

                <div class="mb-4">
                    @foreach ($roles as $role)
                        <div class="mb-2 flex items-center">
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                @if ($user->roles->contains($role->id)) checked @endif class="mr-2" />
                            <label class="text-gray-700">{{ $role->description }}</label>
                        </div>
                    @endforeach
                </div>

                <p class="text-xl font-semibold mb-4">Permisos</p>

                <div class="mb-4">
                    @foreach ($permissions as $permission)
                        <div class="mb-2 flex items-center">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                @if ($user->permissions->contains($permission->id)) checked @endif class="mr-2" />
                            <label class="text-gray-700">{{ $permission->description }}</label>
                        </div>
                    @endforeach
                </div>

                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">{{ __('Editar') }}</x-primary-button>
            </form>
        </div>
    </div>
@endsection
