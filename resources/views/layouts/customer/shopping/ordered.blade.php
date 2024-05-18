@extends('layouts.customer.guest')

@section('title', 'Lias Store | Pedidos')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-bag-shopping"></i>
        {{ __('Pedidos') }}
    </h2>
@endsection

@section('main')

    <livewire:order-details lazy/>

@endsection
