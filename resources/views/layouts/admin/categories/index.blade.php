@extends('layouts.admin.app')

@section('title','Administrador | Categorias')


@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <i class="fa-brands fa-shopify"></i>
    {{ __('Categorias') }}
</h2>
@endsection

@section('main')
    <section class="p-5">

        <a class="mb-4 p-4 bg-slate-300 cursor-pointer" href="{{ route('categories.create') }}">
                {{__('Create')}}
        </a>
        <div class="grid grid-cols-1 gap-4 font-bold sm:grid-cols-2 md:grid-cols-3">
            @foreach ($categories as $category )
                <div class="flex flex-col items-center justify-center bg-slate-400">
                    <picture>
                        <source srcset="{{ asset('storage/images/').'/'. $category -> file_url. '.webp'}}" type="image/webp" >
                        <source srcset="{{ asset('storage/images/').'/'. $category -> file_url. '.png'}}" type="image/png" >
                        <img
                            loading="lazy"
                            width="200px"
                            height="300px"
                            src="{{ asset('storage/images/').'/'. $category -> file_url. '.png' }}"
                            alt="imagen {{  $category -> file_url }}">
                    </picture>

                    <h2>{{$category -> name}}</h2>
                    <x-link href="{{route('categories.edit',$category -> id)}}" >{{__('Edit')}}</x-link>
                </div>
            @endforeach
        </div>
    </section>
@endsection
