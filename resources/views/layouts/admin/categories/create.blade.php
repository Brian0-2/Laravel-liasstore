@extends('layouts.admin.app')

@section('title', 'Administrador | Crear Categorias')


@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-brands fa-shopify"></i>
        {{ __('Crear Categorias') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <a href="{{route('categories.index')}}" class="bg-red-300 cursor-pointer p-2 mb-2">
            Volver
        </a>
        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf

            <x-input-label for="name" :value="__('Nombre de prenda')" />
            <x-text-input name="name" type="text" class="mt-1 block w-full" value="{{old('name')}}" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />

            <input
                type="file"
                id="file_url"
                name="file_url"
                accept=".jpg, .jpeg, .png"
                class="block p-2 text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 my-2"
                onchange="previewImage(event)"
            >
            <x-input-error class="mt-2" :messages="$errors->get('file_url')" />


            <img width="200px" height="200px" loading="lazy" id="imagePreview" style="display: none;" />

            <div class="flex justify-center items-center" id="spinner" style="display: none;">
                <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 h-8 " viewBox="0 0 24 24">
                    <circle cx="4" cy="12" r="3" fill="black">
                        <animate id="svgSpinners3DotsBounce0" attributeName="cy" begin="0;svgSpinners3DotsBounce1.end+0.25s"
                            calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12" />
                    </circle>
                    <circle cx="12" cy="12" r="3" fill="black">
                        <animate attributeName="cy" begin="svgSpinners3DotsBounce0.begin+0.1s" calcMode="spline"
                            dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12" />
                    </circle>
                    <circle cx="20" cy="12" r="3" fill="black">
                        <animate id="svgSpinners3DotsBounce1" attributeName="cy" begin="svgSpinners3DotsBounce0.begin+0.2s"
                            calcMode="spline" dur="0.6s" keySplines=".33,.66,.66,1;.33,0,.66,.33" values="12;6;12" />
                    </circle>
                </svg>
            </div>

            <x-primary-button >{{__('Create')}}</x-primary-button>

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
