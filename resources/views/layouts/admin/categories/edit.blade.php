@extends('layouts.admin.app')

@section('title', 'Admin Categories')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-brands fa-shopify"></i>
        <i class="fa-solid fa-pen-to-square"></i>
        {{ __('Editar Categoria') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <form method="POST" action="{{ route('categories.update',$category -> id) }}" enctype="multipart/form-data" id="form" >
            @csrf
            @method('PUT')
            <x-input-label for="name" :value="__('Nombre de prenda')" />
            <x-text-input name="name" type="text" class="mt-1 block w-full" value="{{$category -> name}}" />

            <div class="p-5 bg-slate-400">
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
                <input type="hidden" name="currentFile"  value="{{ $category -> file_url }}">

                <input type="file" name="new_file">

            </div>

            <x-primary-button id="button">{{ __('Editar') }}</x-primary-button>

        </form>
    </div>
@endsection
