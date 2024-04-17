@extends('layouts.admin.app')

@section('title')
    Administrador | Usuarios
@endsection



@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-shirt"></i>
        {{ __('Lista de Prendas') }}
    </h2>
@endsection

@section('main')
    <livewire:admin.clothes-index lazy />
@endsection


