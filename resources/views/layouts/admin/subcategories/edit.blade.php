@extends('layouts.admin.app')

@section('title', 'Administrador | Editar subcategoria')

@section('main')
    <div class="p-5">
        <x-link :href="route('categories.index')" class="p-3 bg-red-500 text-white font-bold">
            Volver
        </x-link>
        <form method="POST" action="{{ route('subcategories.update', $subcategory -> id) }}" class="mt-3" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-input-label for="name" :value="__('Nombre de la subcategoria')" />
            <x-text-input id="name" name="name"  :value="old('name', $subcategory -> name)" autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />

            <div id="currentImage">
                <x-input-label  for="name" :value="__('Imagen actual')" />
                <x-dynamic-images class="currentInputImage" :file_url="$subcategory->file_url" />
            </div>

            <x-input-label for="file" :value="__('Cambiar Imagen')" />
            <x-input-file type="file" id="new_file" name="file_url"></x-input-file>  {{-- has onchange event --}}
            <x-input-error class="mt-2" :messages="$errors->get('file_url')" />


            <input type="hidden" name="current_image" value="{{ $subcategory -> file_url }}">

            <img loading="lazy" width="200px" height="300px" id="imagePreview" class="hidden" />
            <div id="spinner" class="hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 " viewBox="0 0 24 24"><circle cx="12" cy="3" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle0" attributeName="r" begin="0;svgSpinners6DotsScaleMiddle2.end-0.5s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="16.5" cy="4.21" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle1" attributeName="r" begin="svgSpinners6DotsScaleMiddle0.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="7.5" cy="4.21" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle2" attributeName="r" begin="svgSpinners6DotsScaleMiddle4.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="19.79" cy="7.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle3" attributeName="r" begin="svgSpinners6DotsScaleMiddle1.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="4.21" cy="7.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle4" attributeName="r" begin="svgSpinners6DotsScaleMiddle6.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="21" cy="12" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle5" attributeName="r" begin="svgSpinners6DotsScaleMiddle3.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="3" cy="12" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle6" attributeName="r" begin="svgSpinners6DotsScaleMiddle8.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="19.79" cy="16.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle7" attributeName="r" begin="svgSpinners6DotsScaleMiddle5.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="4.21" cy="16.5" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle8" attributeName="r" begin="svgSpinners6DotsScaleMiddlea.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="16.5" cy="19.79" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddle9" attributeName="r" begin="svgSpinners6DotsScaleMiddle7.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="7.5" cy="19.79" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddlea" attributeName="r" begin="svgSpinners6DotsScaleMiddleb.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle><circle cx="12" cy="21" r="0" fill="black"><animate id="svgSpinners6DotsScaleMiddleb" attributeName="r" begin="svgSpinners6DotsScaleMiddle9.begin+0.1s" calcMode="spline" dur="0.6s" keySplines=".27,.42,.37,.99;.53,0,.61,.73" values="0;2;0"/></circle></svg>
            </div>

            <x-primary-button id="button">{{ __('Edit') }}</x-primary-button>

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
                    //hide current image
                    const currentImage = document.querySelector('#currentImage')
                    currentImage.style.display = 'none';
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
