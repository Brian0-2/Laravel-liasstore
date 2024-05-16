@extends('layouts.customer.guest')

@section('title', 'LiasStore | Categoría: ' . $category->name)

@section('header')
<h2 class="text-3xl font-bold text-gray-800 mb-4">
    {{ $category->name }}
</h2>
@endsection

@section('main')
<div class="flex flex-col min-h-screen">
    <!-- Contenedor de contenido principal -->
    <div class="container mx-auto p-6 flex-grow">
        <!-- Encabezado adicional para la sección de subcategorías -->
        <div class="mb-6">
            <h3 class="text-2xl font-bold text-gray-800">
                Explora nuestras subcategorías de {{ $category->name }}
            </h3>
            <p class="text-gray-600">
                Descubre una variedad de estilos y productos en nuestras subcategorías.
            </p>
        </div>

        <!-- Componente de subcategorías -->
        <div class="bg-transparent">
            <livewire:components.swiper-sub-category :subCategories="$subCategories" />
        </div>
    </div>
</div>
@endsection

@section('main')
     <livewire:components.swiper-sub-category :subCategories="$subCategories"/>
@endsection
