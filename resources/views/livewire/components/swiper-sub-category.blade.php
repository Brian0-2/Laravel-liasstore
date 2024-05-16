<div class="h-screen w-full">
    <div class="swiper slider h-full w-full">
        <div class="swiper-wrapper h-full bg-slate-100">
            @foreach ($subCategories as $index => $sub)
                <a href="{{ route('subcategory.show', $sub->id) }}"
                   class="swiper-slide flex flex-col items-center justify-center bg-white p-4 rounded-lg cursor-pointer shadow-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:scale-105 mx-2 h-24 w-32">
                    <!-- Imagen -->
                    <div class="w-full h-full overflow-hidden rounded-lg mb-2">

                             <x-images :file_url="$sub->file_url" class="w-full h-full object-cover" />
                    </div>
                    <!-- Nombre de la subcategoría -->
                    <p class="text-md font-semibold text-gray-800 text-center">{{ $sub->name }}</p>
                </a>
            @endforeach
        </div>
        <!-- Controles de navegación -->
        <div class="swiper-button-next text-gray-800 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 transition absolute top-1/2 transform -translate-y-1/2 right-4">
            <i class="fas fa-chevron-right"></i>
        </div>
        <div class="swiper-button-prev text-gray-800 bg-white rounded-full p-2 shadow-md hover:bg-gray-200 transition absolute top-1/2 transform -translate-y-1/2 left-4">
            <i class="fas fa-chevron-left"></i>
        </div>
    </div>
</div>
