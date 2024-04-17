<!-- component -->
@extends('layouts.admin.app')

@section('title')
    Administrador | Editar Usuarios
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-pen-to-square"></i>
        <i class="fa-solid fa-user"></i>
        {{ __('Editar Usuario') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('users.index')" class="bg-red-400 p-3 text-white font-bold">
            Volver
        </x-link>

        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('users.update', $user->id) }}" novalidate>
                @csrf
                @method('put')
                <p class="p-4">Datos personales</p>

                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />

                <x-input-label for="email" :value="__('Correo')" />
                <x-text-input id="email" name="email" type="text" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autofocus autocomplete="email" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                <p class="p-4">Direccion</p>

                <x-input-label for="address" :value="__('Direccion')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)"
                    required autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />

                <x-input-label for="postal_code" :value="__('Codigo postal')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full"
                    :value="old('postal_code', $user->postal_code)" required autofocus autocomplete="postal_code" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />

                <x-input-label for="location" :value="__('Localidad')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)"
                    required autofocus autocomplete="location" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />

                <x-input-label for="municipality" :value="__('Municipio')" />
                <x-text-input id="municipality" name="municipality" type="text" class="mt-1 block w-full"
                    :value="old('municipality', $user->municipality)" required autofocus autocomplete="municipality" />
                <x-input-error class="mt-2" :messages="$errors->get('municipality')" />

                <x-input-label for="state" :value="__('Estado')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $user->state)"
                    required autofocus autocomplete="state" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />

                <x-input-label for="phone_number" :value="__('Telefono')" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                    :value="old('phone_number', $user->phone_number)" required autofocus autocomplete="phone_number" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />

                <x-input-error class="mt-2" :messages="$errors->get('roles')" />

                <x-input-label class="font-bold text-4xl p-4" for="phone_number" :value="__('Roles')" />
                @foreach ($roles as $role)
                    <div class="">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                            @if ($user->roles->contains($role->id)) checked @endif />
                        <label>{{ $role->description }}</label>
                    </div>
                @endforeach
                <x-input-label class="font-bold text-4xl p-4" for="phone_number" :value="__('Permisos')" />
                @foreach ($permissions as $permission)
                    <div class="p-2">
                        <input class="form-checkbox cursor-pointer ms-2 h-6 w-6 text-red-900" type="checkbox"
                            name="permissions[]" value="{{ $permission->id }}"
                            @if ($user->permissions->contains($permission->id)) checked @endif />
                        <label>{{ $permission->description }}</label>
                    </div>
                @endforeach

                <x-primary-button>{{ __('Editar') }}</x-primary-button>
            </form>
        </div>
    </div>
    @endsection
