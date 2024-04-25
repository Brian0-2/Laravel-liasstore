
@extends('layouts.customer.guest')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <span>{{ $category -> name }}</span> > {{$subcategory -> name}}
    </h2>
@endsection

@section('main')
    <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
        @forelse ($clothesWithPhotos as $clothe )
        <div class="bg-white my-4 mx-4 m-auto flex flex-col items-center p-5">
            <picture>
                <source srcset="{{ asset('storage/images/').'/'. $clothe -> file_url . '.webp'}}" type="image/webp" >
                <source srcset="{{ asset('storage/images/').'/'. $clothe -> file_url . '.png'}}" type="image/png" >
                <img loading="lazy" width="200px" height="300px"  src="{{ asset('storage/images/').'/'. $clothe -> file_url. '.png' }}" alt="imagen {{ $clothe -> file_url }}">
            </picture>
            <p>{{$clothe -> name}}</p>
            <p>{{ $clothe -> unit_price }}</p>
        </div>
        @empty
            <p>No hay resultados...</p>
        @endforelse

    </section>
@endsection
