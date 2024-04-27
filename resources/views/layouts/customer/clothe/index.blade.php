@extends('layouts.customer.guest')

@section('title', 'LiasStore | articulo: '. $clothe -> name)

@section('main')
    <section class="grid grid-cols-1 gap-4  justify-items-center sm:grid-cols-2 p-5">
        <div class="">
            <x-input-label :value="__('Prenda')" />
            <x-input-label  value="{{ $clothe -> name}}" />
            <x-input-label  value="{{'Folio: ' . $clothe -> id}}" />
            <x-input-label  value="{{'Detalles: ' . $clothe -> description}}" />
            <x-input-label :value="__('Imagenes de prenda')" />
            @foreach ($photos as $photo)
                <x-dynamic-images :file_url="$photo -> file_url" />
            @endforeach
            <x-input-label :value="__('Colores Disponibles')" />
            @forelse ($colors as $color)
                <div class="w-8 h-8 rounded-full border-4 border-black"
                    style="background-color: {{ $color->name }}">
                </div>
                @empty
                <p>No hay colores disponibles.</p>
            @endforelse
            <x-input-label :value="__('Tallas disponibles')" />
            @foreach ($sizes as $size )
                <ul>
                    <li>
                        {{ $size -> name }}
                    </li>
                </ul>
            @endforeach
        </div>
        <div class="">
            <x-input-label for="name" :value="__('Acciones')" />
            @auth
                <a href="" class="bg-green-600 p-2 font-bold rounded-lg cursor-pointer">Apartar</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="bg-orange-300 p-2 font-bold rounded-lg cursor-pointer">Inisiar Sesion para poder apartar</a>
            @endguest
        </div>
    </section>
@endsection
