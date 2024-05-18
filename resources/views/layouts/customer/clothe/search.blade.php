@extends('layouts.customer.guest')

@section('title', 'LiasSore | Buscar')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Buscar') }}
</h2>
@endsection

@section('main')
    <livewire:components.search-clothes />
@endsection
