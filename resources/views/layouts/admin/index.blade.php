@extends('layouts.admin.app')

@section('title')
    Administrador | Home
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center space-x-2">
        <i class="fa-solid fa-signal text-green-500"></i>
        <span class="hover:text-green-600 transition-colors duration-300">
            {{ __('Resumen') }}
        </span>
    </h2>
@endsection

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-gray-900 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-center">
                    <div class="hover:bg-blue-100 p-4 rounded-md transition-colors duration-300 flex flex-col items-center">
                        <i class="fa-solid fa-user text-blue-500 text-3xl mb-2"></i>
                        <p>Usuarios</p>
                        <p>{{ $users }}</p>
                    </div>
                    <div class="hover:bg-yellow-100 p-4 rounded-md transition-colors duration-300 flex flex-col items-center">
                        <i class="fa-solid fa-truck text-yellow-500 text-3xl mb-2"></i>
                        <p>Proveedores</p>
                        <p>{{ $providers }}</p>
                    </div>
                    <div class="hover:bg-green-100 p-4 rounded-md transition-colors duration-300 flex flex-col items-center">
                        <i class="fa-solid fa-tshirt text-green-500 text-3xl mb-2"></i>
                        <p>Prendas</p>
                        <p>{{ $clothes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
