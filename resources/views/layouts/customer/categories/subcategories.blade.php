@extends('layouts.customer.guest')

@section('title', 'LiasStore | Subcategoría: ' . $subcategory->name)

@section('header')
    <h2 class="text-2xl font-semibold text-gray-800 leading-tight mb-4">
        <a href="{{ route('category.show', $category->id) }}" class="text-blue-500 hover:underline">{{ $category->name }}</a>
        &gt;
        <a href="{{ route('subcategory.show', $subcategory->id) }}" class="text-blue-500 hover:underline">{{ $subcategory->name }}</a>
    </h2>
@endsection

@section('main')
    <section class="container mx-auto grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-5">
        @forelse ($clothes as $clothe)
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                <div class="mb-4">
                    <x-images :file_url="$clothe->file_url" />
                </div>
                <p class="text-lg font-semibold text-gray-800 mb-2">{{ $clothe->name }}</p>
                <div class="flex justify-evenly gap-2 mb-4">
                    @foreach ($clothe->sizes as $size)
                        <p class="bg-gray-200 px-3 py-1 rounded-md text-gray-700">{{ $size }}</p>
                    @endforeach
                </div>
                <a href="{{ route('clothe.show', $clothe->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">Detalles</a>
            </div>
        @empty
            <p class="text-center text-gray-500">No hay resultados...</p>
        @endforelse
    </section>
@endsection
