@extends('layouts.customer.guest')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $category -> name }}
    </h2>
@endsection

@section('main')
    <livewire:components.swiper-sub-category :subCategories="$subCategories"/>
@endsection
