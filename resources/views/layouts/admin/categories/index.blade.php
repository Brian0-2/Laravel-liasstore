@extends('layouts.admin.app')

@section('title', 'Administrador | Categorías')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-6">
        <i class="fa-brands fa-shopify "></i>
        {{ __('Categorías') }}
    </h2>
@endsection

@section('main')
    <section class="p-6 bg-gray-100">

        <div class="mb-4 bg-white p-6 rounded-lg">
            <a class="bg-blue-500 p-3 rounded-lg mb-4" href="{{ route('categories.create') }}">Crear nueva categoría <span
                    class="uppercase text-white">+</span></a>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-6">
                @foreach ($categories as $category)
                    <div class="bg-gray-200 rounded-lg shadow-md p-4 flex flex-col items-center">
                        <x-images :file_url="$category->file_url" class="rounded-lg w-full h-48 object-cover mb-4" />
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $category->name }}</h3>

                        <div class="flex w-full justify-between">
                            <x-link
                                href="{{ route('categories.edit', $category->id) }}"
                                class="text-white bg-gradient-to-r bg-green-500  uppercase dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                            >
                                Editar
                            </x-link>
                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-danger-button class="text-white bg-gradient-to-r  to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none  dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    {{ __('Borrar') }}
                                </x-danger-button>
                            </form>
                        </div>

                        <x-link class="mt-4 px-4 py-2 bg-blue-800 text-white rounded-lg font-semibold hover:bg-blue-900 transition"
                            href="{{ route('subcategories.create', $category->id) }}">
                            {{ __('Crear o Editar Subcategoría') }}
                        </x-link>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
