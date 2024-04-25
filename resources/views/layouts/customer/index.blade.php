@extends('layouts.customer.guest')

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Home') }}
</h2>

@endsection
@section('main')
<!-- Hero Section -->
    <section class="h-screen w-screen overflow-x-hidden">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 h-full w-full">
            <!-- Colums 1 -->
            @foreach ($categories as $category )
            <div class="relative group overflow-hidden w-full h-full">
                <picture>
                    <source srcset="{{ asset('storage/images/').'/'. $category -> file_url. '.webp'}}" type="image/webp" >
                    <source srcset="{{ asset('storage/images/').'/'. $category -> file_url. '.png'}}" type="image/png" >
                    <img
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                        width="200px"
                        height="300px"
                        src="{{ asset('storage/images/').'/'. $category -> file_url. '.png' }}"
                        alt="imagen {{  $category -> file_url }}">
                </picture>
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="text-center">
                        <h3 class="text-white text-3xl">{{$category -> name}}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>


@endsection
