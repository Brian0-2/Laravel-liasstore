@extends('layouts.admin.app')

@section('title','Administrador | Ordenes')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-cart-shopping"></i>
        Lista de: <span class="font-normal">{{ $user -> name}}</span>
    </h2>
    <p class="text-blue-500 font-bold">Total de pedidos: <span class="font-normal">{{ $total }}</span></p>
@endsection

@section('main')
    <livewire:admin.orders-user :userId="$userId" />
@endsection
