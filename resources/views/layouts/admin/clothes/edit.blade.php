@extends('layouts.admin.app')

@section('title')
    Administrador | Editar Prenda
@endsection

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center space-x-2">
        <i class="fa-solid fa-pen-to-square text-black"></i>
        <i class="fa-solid fa-shirt text-black"></i>
        <span class="hover:text-indigo-700 transition-colors duration-300">
            {{ __('Editar Prenda') }}
        </span>
    </h2>
@endsection

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <x-link :href="route('clothes.index')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-md transition-colors duration-300">
                    Volver
                </x-link>

                <div class="p-6 text-gray-900 mt-4">
                    <form method="POST" action="{{ route('clothes.update', $clothes->id) }}" novalidate enctype="multipart/form-data" id="form">
                        @csrf
                        @method('PUT')

                        <p class="text-xl font-semibold mb-4">Datos personales</p>

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Prenda')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('name', $clothes->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Descripción')" />
                            <x-textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('description', $clothes->description)">
                                {{ $clothes->description }}
                            </x-textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="unit_price" :value="__('Precio Unitario')" />
                            <x-text-input id="unit_price" name="unit_price" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                :value="old('unit_price', $clothes->unit_price)" required autofocus autocomplete="unit_price" />
                            <x-input-error class="mt-2" :messages="$errors->get('unit_price')" />
                        </div>

                        <p class="text-xl font-semibold mb-4">Categoría</p>

                        <div class="mb-4">
                            <x-input-label :value="__('Categorías Actuales')" />
                            <livewire:components.select-categories :category="$currentCategory->id" :subcategoryId="$currentSubCategory->id" />
                        </div>

                        <p class="text-xl font-semibold mb-4">Proveedor</p>

                        <div class="mb-4">
                            <x-input-label for="provider" :value="__('Proveedor')" />
                            <x-select name="provider_id" class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Selecciona un proveedor</option>
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}" {{ $clothes->provider_id == $provider->id ? 'selected' : '' }}>
                                        {{ $provider->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>

                        <p class="text-xl font-semibold mb-4">Colores</p>

                        @if (isset($colors) && count($colors) > 0)
                            <x-input-label :value="__('Colores Actuales')" />
                            <div class="flex gap-2">
                                @foreach ($colors as $color)
                                    <div class="w-8 h-8 rounded-full border-4 border-black"
                                        style="background-color: {{ $color->name }}">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <x-input-label :value="__('Agregar Colores')" />
                        @endif

                        <livewire:components.clothe-colors />

                        <p class="text-xl font-semibold mb-4">Imágenes</p>

                        <x-input-label :value="__('Imágenes Actuales')" />
                        <div class="flex flex-col flex-wrap md:flex-row md:gap-2">
                            @foreach ($photos as $picture)
                                <x-images :file_url="$picture -> file_url" />
                            @endforeach
                        </div>
                        <x-input-label :value="__('Cambiar Imágenes')" />
                        <livewire:components.images-clothes />

                        <p class="text-xl font-semibold mb-4">Tallas</p>

                        <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.sizes')" />
                        @foreach ($sizes as $index => $size)
                            <div class="mb-2 flex items-center">
                                <input class="form-checkbox cursor-pointer ms-2 h-6 w-6 text-indigo-600" type="checkbox"
                                    wire:model="clotheCreate.sizes"
                                    value="{{ $size->id }}"
                                    name="sizes[]"
                                    {{ $clothes->sizes->contains($size->id) ? 'checked' : '' }} />
                                <label class="ml-2 text-gray-700">{{ $size->name }}: {{ $size->description }}</label>
                            </div>
                        @endforeach

                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-md">{{ __('Editar') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        const button = document.querySelector('#form .x-primary-button');
        button.addEventListener('click', mostrarAlerta);

        function mostrarAlerta(event) {
            event.preventDefault();

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Estás seguro de que deseas editar esta prenda?',
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


