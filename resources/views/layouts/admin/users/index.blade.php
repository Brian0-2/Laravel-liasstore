@extends('layouts.admin.app')

@section('title')
    Administrador | Usuarios
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-user"></i>
        {{ __('Lista de Usuarios') }}
    </h2>
@endsection

@section('main')
    @livewire('admin.user-index')
@endsection

