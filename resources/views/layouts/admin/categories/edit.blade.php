@extends('layouts.admin.app')

@section('title', 'Administrador | Editar Categorias')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-brands fa-shopify"></i>
        <i class="fa-solid fa-pen-to-square"></i>
        {{ __('Editar Categoria') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <x-link :href="route('categories.index')" class="p-3 bg-red-500 text-white font-bold ">
            Volver
        </x-link>

        <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data" id="form" class="mt-3">
            @csrf
            @method('PUT')
            <x-input-label for="name" :value="__('Nombre de prenda')" />
            <x-text-input name="name" type="text" class="mt-1 block w-full" value="{{ $category->name }}" />

            <x-input-label for="name" :value="__('Imagen actual')" />

            <div class="p-5 bg-slate-400">
                <x-dynamic-images id="currentImage" :file_url="$category->file_url" />

                <input type="hidden" name="currentFile" value="{{ $category->file_url }}">

                <input type="file" id="new_file" name="new_file" accept=".jpg, .jpeg, .png"
                    class="block p-2 text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 my-2"
                    onchange="previewImage(event)">

                <img loading="lazy" width="200px" height="300px" id="imagePreview" style="display: none;" />

                <div id="spinner" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 " viewBox="0 0 24 24"><circle cx="12" cy="3" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle0" attributeName="r" begin="0;svgSpinners6DotsScaleMiddle2.end-0.5s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="16.5" cy="4.21" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle1" attributeName="r" begin="svgSpinners6DotsScaleMiddle0.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="7.5" cy="4.21" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle2" attributeName="r" begin="svgSpinners6DotsScaleMiddle4.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="19.79" cy="7.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle3" attributeName="r" begin="svgSpinners6DotsScaleMiddle1.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="4.21" cy="7.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle4" attributeName="r" begin="svgSpinners6DotsScaleMiddle6.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="21" cy="12" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle5" attributeName="r" begin="svgSpinners6DotsScaleMiddle3.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="3" cy="12" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle6" attributeName="r" begin="svgSpinners6DotsScaleMiddle8.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="19.79" cy="16.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle7" attributeName="r" begin="svgSpinners6DotsScaleMiddle5.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="4.21" cy="16.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle8" attributeName="r" begin="svgSpinners6DotsScaleMiddlea.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="16.5" cy="19.79" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle9" attributeName="r" begin="svgSpinners6DotsScaleMiddle7.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="7.5" cy="19.79" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddlea" attributeName="r" begin="svgSpinners6DotsScaleMiddleb.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="12" cy="21" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddleb" attributeName="r" begin="svgSpinners6DotsScaleMiddle9.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle></svg>
                </div>

            </div>

            <x-primary-button id="button">{{ __('Editar') }}</x-primary-button>

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
                    preview.style.display = 'block';
                    spinner.style.display = 'none';
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
