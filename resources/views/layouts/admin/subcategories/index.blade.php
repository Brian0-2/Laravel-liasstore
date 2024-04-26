@extends('layouts.admin.app')

@section('title', 'Administrador | Sub categorias')
@push('styles')
    <style>
        /* Estilos personalizados para la barra de desplazamiento */
        .subcategory::-webkit-scrollbar {
            width: 8px;
        }
        .subcategory::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .subcategory::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

    </style>
@endpush

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-brands fa-shopify"></i>
        {{ __('Sub Categorias') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('categories.index')" class="p-3 bg-red-500 text-white font-bold">
            Volver
        </x-link>
        <div class=" grid grid-cols-1 justify-items-center items-center sm:grid-cols-2">
            <div class="">
                <x-input-label for="name" value="Categoria: {{ $category->name }}" class="mt-3" />
                <img loading="lazy" width="200px" height="300px" src="{{ asset('storage/images/') . '/' . $category->file_url . '.webp' }}"
                    alt="Imagen {{ $category->file_url }}"
                    class="rounded-lg"
                >
                    <ul class="list-none max-h-60 overflow-y-auto overflow-hidden subcategory">
                        @foreach ($subcategories as $index => $subcategory)
                            <li class="flex justify-evenly items-center text-lg font-semibold text-gray-800 border-b py-2">
                                <p>{{ $subcategory->name }}</p>
                                <x-link href="{{ route('subcategories.edit', $subcategory->id) }}" >
                                    Editar
                                </x-link>
                            </li>
                        @endforeach
                    </ul>
            </div>
            <div class="">
                <x-input-label for="name" :value="__('Nueva categoria')" />

                <form method="POST" action="{{ route('subcategories.store') }}" enctype="multipart/form-data">
                    @csrf

                    <x-input-label for="name" :value="__('Nombre de la subcategoria')" />
                    <x-text-input id="name" name="name" class="mt-1 block w-full" :value="old('name')" autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />

                    <x-input-label for="name" :value="__('Imagen')" />
                    <input type="file" name="file_url" accept=".jpg, .jpeg, .png" id="file-input"
                        class="block p-2 text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 my-2">
                    <x-input-error class="mt-2" :messages="$errors->get('file_url')" />

                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />

                    <x-button>{{ __('Create') }}</x-button>
                </form>
            </div>
        </div>
    </div>
@endsection
