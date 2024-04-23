@extends('layouts.admin.app')

@section('title','admin')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <i class="fa-brands fa-shopify"></i>
    {{ __('Crear Categorias') }}
</h2>
@endsection

@section('main')
    <div class="p-5">
        <livewire:Admin.categories-form lazy/>
    </div>
@endsection


