@extends('layouts.customer.guest')

@section('title', 'Lias Store | Pedidos')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-bag-shopping"></i>
        {{ __('Pedidos') }}
    </h2>
@endsection

@section('main')

<livewire:order-details />
    {{-- <section class="p-5">
        @forelse ($orders as $order )
            <div class="shadow-lg p-5">
                <p>Folio del pedido: {{$order -> id}}</p>
                <p>Estado: {{$order -> state === 'pending' ? 'Pendiente' : ''}}</p>
                <p>Total: ${{ $order -> total }}</p>
                <p>Ordenada el dia : {{$order -> created_at -> toFormattedDateString()}}</p>
                <x-link
                    href="{{ route('user-order',$order -> id) }}"
                    class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out"
                >
                    Detalles
                </x-link>
            </div>
        @empty
            <p class="text-center font-bold">No has apartado prendas aun... <a class="text-blue-500" href="{{ route('index') }}">Elegir prendas</a></p>
        @endforelse
    </section> --}}
@endsection
