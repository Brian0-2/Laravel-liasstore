@extends('layouts.admin.app')

@section('title')
    Administrador | Editar Proveedores
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-pen-to-square"></i>
        <i class="fa-solid fa-truck-fast"></i>
        {{ __('Editar Proveedor') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('providers.index')" class="p-4 bg-red-500 text-white font-bold mt-5">
            Volver
        </x-link>
        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('providers.update', $provider->id) }}" novalidate id="form">
                @csrf
                @method('put')
                <p class="p-4">Datos personales</p>

                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $provider->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />

                <x-input-label for="store_name" :value="__('Nombre de la tienda')" />
                <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full" :value="old('store_name', $provider->store_name)"
                    required autofocus autocomplete="store_name" />
                <x-input-error class="mt-2" :messages="$errors->get('store_name')" />

                <x-input-label for="nickname" :value="__('Sub Nombre')" />
                <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $provider->nickname)"
                    required autofocus autocomplete="nickname" />
                <x-input-error class="mt-2" :messages="$errors->get('nickname')" />

                <p class="p-4">Direccion</p>

                <x-input-label for="address" :value="__('Dirección')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $provider->address)"
                    required autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />

                <x-input-label for="postal_code" :value="__('Codigo postal')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full"
                    :value="old('postal_code', $provider->postal_code)" required autofocus autocomplete="postal_code" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />

                <x-input-label for="location" :value="__('Localidad')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $provider->location)"
                    required autofocus autocomplete="location" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />

                <x-input-label for="municipality" :value="__('Municipio')" />
                <x-text-input id="municipality" name="municipality" type="text" class="mt-1 block w-full"
                    :value="old('municipality', $provider->municipality)" required autofocus autocomplete="municipality" />
                <x-input-error class="mt-2" :messages="$errors->get('municipality')" />

                <x-input-label for="state" :value="__('Estado')" />
                <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $provider->state)"
                    required autofocus autocomplete="state" />
                <x-input-error class="mt-2" :messages="$errors->get('state')" />


                <x-input-label for="phone_number" :value="__('Numero de telefono')" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full"
                    :value="old('phone_number', $provider->phone_number)" required autofocus autocomplete="phone_number" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />

                <x-primary-button id="button">{{ __('Editar') }}</x-primary-button>
            </form>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        const button = document.querySelector('#button');
        button.addEventListener('click', mostrarAlerta)

        function mostrarAlerta(event){
            event.preventDefault();

            Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Estás seguro de que deseas editar este proveedor?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
             document.querySelector('#form').submit();
            }
        });
        }

    </script>
@endpush
