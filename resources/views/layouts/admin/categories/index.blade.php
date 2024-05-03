@extends('layouts.admin.app')

@section('title','Administrador | Categorias')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-brands fa-shopify"></i>
        {{ __('Categorias') }}
    </h2>
@endsection

@section('main')
    <section class="p-5">

        <x-link :href=" route('categories.create')" class="p-3 bg-red-500 text-white font-bold" >
            {{__('Crear Categoria')}}
        </x-link>

        <div class="grid grid-cols-1 gap-4 font-bold mt-3 sm:grid-cols-2 md:grid-cols-3">
            @foreach ($categories as $category )
                <div class="flex flex-col items-center justify-center bg-slate-400">

                    <x-images :file_url="$category -> file_url" />
                        
                    <h2>{{$category -> name}}</h2>
                    <div class="flex justify-between items-center">
                        <x-link
                            href="{{ route('categories.edit', $category->id) }}"
                            class="text-white bg-gradient-to-r bg-green-500  uppercase dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                            >Editar
                        </x-link>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button
                                class="text-white bg-gradient-to-r  to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none  dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                {{ __('Borrar') }}
                            </x-danger-button>
                        </form>
                    </div>
                    <x-link class="mb-4 p-4 bg-slate-300 cursor-pointer" href="{{ route('subcategories.create', $category -> id) }}">{{__('Crear subcategoria')}}</x-link>
                </div>
            @endforeach
        </div>
    </section>
@endsection
