@extends('layouts.admin.app')

@section('title', 'Administrador | Editar Categorías')

@section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center space-x-2">
        <i class="fa-brands fa-shopify "></i>
        <i class="fa-solid fa-pen-to-square "></i>
        <span class="hover:text-indigo-700 transition-colors duration-300">
            {{ __('Editar Categoria') }}
        </span>
    </h2>
@endsection

@section('main')
    <div class="container mx-auto p-6">
        <a href="{{ route('providers.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-md transition-colors duration-300 inline-block mb-4">
            Volver
        </a>

        <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data" id="form" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nombre de prenda')" />
                <x-text-input name="name" type="text" class="mt-1 block w-full border border-gray-300 p-2 rounded-lg" value="{{ $category->name }}" />
            </div>

            <div class="mb-4">
                <x-input-label for="currentImage" :value="__('Imagen actual')" />

                <div class="p-5 bg-gray-100 rounded-lg mb-4 border border-gray-200 shadow-md inline-block" id="imageContainer">
                    <div id="currentImage">
                        <x-images id="currentImage" :file_url="$category->file_url" class="rounded-lg" />
                    </div>
                    <input type="hidden" name="currentFile" value="{{ $category->file_url }}">

                    <input type="file" id="new_file" name="new_file" accept=".jpg, .jpeg, .png"
                        class="block p-2 mt-2 border rounded-lg cursor-pointer text-gray-600 focus:outline-none bg-gray-200"
                        onchange="previewImage(event)">

                    <img loading="lazy" width="200px" height="300px" id="imagePreview" class="mt-4 rounded-lg hidden" />

                    <div id="spinner" class="mt-4 hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 mx-auto text-green-600 animate-spin" viewBox="0 0 24 24">
                            <circle cx="12" cy="3" r="0" fill="currentColor">
                                <animate id="svgSpinners6DotsScaleMiddle0" attributeName="r" begin="0;svgSpinners6DotsScaleMiddle2.end-0.5s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/>
                            </circle>
                            <circle cx="16.5" cy="4.21" r="0" fill="currentColor">
                                <animate id="svgSpinners6DotsScaleMiddle1" attributeName="r" begin="svgSpinners6DotsScaleMiddle0.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/>
                            </circle>
                            <!-- Más círculos animados aquí -->
                        </svg>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-md">
                    {{ __('Editar') }}
                </x-primary-button>
            </div>

        </form>
    </div>
@endsection

@push('javascript')
    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const files = fileInput.files;
            const spinner = document.getElementById('spinner');

            if (files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                spinner.style.display = 'block';

                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    spinner.style.display = 'none';

                    const currentImage = document.querySelector('#currentImage');
                    currentImage.style.display = 'none';
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
