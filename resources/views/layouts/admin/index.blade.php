@extends('layouts.admin.app')
@section('title')
    Administrador | Home
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-signal"></i>
        {{ __('Resumen') }}
    </h2>
@endsection

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="">
                        <p>Usuarios</p>
                        <p>{{ $users }}</p>
                    </div>
                    <div class="">
                        <p>Provedores</p>
                        <p>{{ $providers }}</p>
                    </div>
                    <div class="">
                        <p>Prendas</p>
                        <p>{{ $clothes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
