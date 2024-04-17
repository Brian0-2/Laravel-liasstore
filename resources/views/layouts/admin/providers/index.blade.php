@extends('layouts.admin.app')

@section('title')
    Administrador | Proveedores
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-truck-fast"></i>
        {{ __('Lista de Proveedores') }}
    </h2>
@endsection

@section('main')
    @livewire('admin.provider-index')
@endsection


