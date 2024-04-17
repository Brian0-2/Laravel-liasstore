@extends('layouts.admin.app')

@section('title')
    Administrador | Editar Prenda
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-pen-to-square"></i>
        <i class="fa-solid fa-shirt"></i>

        {{ __('Editar Prenda') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('clothes.index')" class="p-4 bg-red-500 text-white font-bold mt-5">
            Volver
        </x-link>
        <div class="p-6 text-gray-900">
            <form method="POST" action="{{ route('clothes.update', $clothes->id) }}" novalidate enctype="multipart/form-data" id="form">
                @csrf
                @method('put')
                <p class="p-4">Datos personales</p>

                {{-- !name --}}

                <x-input-label for="name" :value="__('Prenda')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $clothes->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />

                {{-- !description --}}

                <x-input-label for="description" :value="__('Descripcion')" />
                <x-textarea id="description" name="description" class="mt-1 block w-full" :value="old('description', $clothes->description)">
                    {{ $clothes->description }}
                </x-textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />

                {{-- !price --}}

                <x-input-label for="unit_price" :value="__('Precio_Unitario')" />
                <x-text-input id="unit_price" name="unit_price" type="text" class="mt-1 block w-full" :value="old('unit_price', $clothes->unit_price)"
                    required autofocus autocomplete="unit_price" />
                <x-input-error class="mt-2" :messages="$errors->get('unit_price')" />

                {{-- !category --}}

                <x-input-label :value="__('Categorias Actuales')" />
                <livewire:components.select-categories :category="$currentCategory -> id" :subcategoryId="$currentSubCategory -> id" />
                <div class="flex">

                </div>

                {{-- !provider --}}

                <x-input-label for="provider" :value="__('Proveedor')" />
                <x-select name="provider_id">
                    <option value="">Selecciona un proveedor</option>
                    @foreach ($providers as $provider)
                        <option value="{{ $provider->id }}" {{ $clothes->provider_id == $provider->id ? 'selected' : '' }}>
                            {{ $provider->name }}
                        </option>
                    @endforeach
                </x-select>

                {{-- !colors --}}
                @if (isset($colors) && count($colors) > 0)
                <x-input-label :value="__('Colores Actuales')" />
                <div class="flex gap-2">
                    @foreach ($colors as $color)
                        <div class="w-8 h-8 rounded-full border-4 border-black"
                            style="background-color: {{ $color->name }}">
                        </div>
                    @endforeach
                </div>
                <x-input-label :value="__('Cambiar Colores')" />
            @else
                <x-input-label :value="__('Agregar Colores')" />
            @endif
                <livewire:components.clothe-colors />

                {{-- !images --}}

                <x-input-label :value="__('Imagenes Actuales')" />
                <div class="flex flex-col flex-wrap md:flex-row md:gap-2">
                    @foreach ($photos as $picture)
                        <div class="my-4">
                            <img class="w-52 h-52" loading="lazy"
                                src="{{ asset('storage/images/') . '/' . $picture->file_url }}"
                                alt="Image {{ $picture->file_url }}">
                        </div>
                    @endforeach
                </div>
                <x-input-label :value="__('Cambiar Imagenes')" />
                <livewire:components.images-clothes />


                {{-- !sizes --}}

                <x-input-label :value="__('Tallas')" />
                <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.sizes')" />
                @foreach ($sizes as $index => $size)
                    <div class="p-2">
                        <input class="form-checkbox cursor-pointer ms-2 h-6 w-6 text-red-900" type="checkbox"
                            wire:model="clotheCreate.sizes"
                            value="{{ $size->id }}"
                            name="sizes[]"
                            {{ $clothes->sizes->contains($size->id) ? 'checked' : '' }}
                        />
                        <label>{{ $size->name }} :</label>
                        <label>{{ $size->description }}</label>
                    </div>
                @endforeach

                <x-primary-button>{{ __('Editar') }}</x-primary-button>
            </form>
        </div>

    </div>
@endsection



