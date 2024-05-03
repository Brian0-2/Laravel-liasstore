
@extends('layouts.customer.guest')

@section('title', 'LiasStore | subcategoria: ' . $subcategory -> name)

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{route('category.show', $category -> id)}}">{{ $category -> name }}</a> > <a href="{{ route('subcategory.show', $subcategory -> id)}}"> {{$subcategory -> name}} </a>
    </h2>
@endsection

@section('main')
    <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($clothesWithPhotos as $clothe )
        <div class="bg-white my-4 mx-4 m-auto flex flex-col items-center p-5">
            <x-images :file_url="$clothe -> file_url" />
            <p>{{$clothe -> name}}</p>
            <p>{{ $clothe -> unit_price }}</p>
            <a href="{{ route('clothe.show', $clothe -> id)}}" class="bg-orange-300 p-2 font-bold rounded-lg cursor-pointer">Detalles</a>
        </div>
        @empty
            <p>No hay resultados...</p>
        @endforelse
    </section>
@endsection
