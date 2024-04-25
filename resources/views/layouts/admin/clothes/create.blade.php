@extends('layouts.admin.app')

@section('title', 'Administrador | Crear Prendas')


@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-shirt"></i>
        {{ __('Crear Prendas') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('clothes.index')" class="bg-red-400 p-3 text-white font-bold">
            Volver
        </x-link>
        <div class="p-6 text-gray-900">
            @livewire('admin.clothes-form')
        </div>
    </div>
@endsection

