@extends('layouts.admin.app')

@section('title')
    Administrador | Crear Prendas
@endsection

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center space-x-2">
        <i class="fa-solid fa-shirt text-black"></i>
        <span class="hover:text-indigo-700 transition-colors duration-300">
            {{ __('Crear Prendas') }}
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
                    @livewire('admin.clothes-form')
                </div>
            </div>
        </div>
    </div>
@endsection
