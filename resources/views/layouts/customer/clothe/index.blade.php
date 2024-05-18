@extends('layouts.customer.guest')

@section('title', 'LiasStore | articulo: ' . $clothe->name)

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a> >
        <a href="{{ route('subcategory.show', $subcategory->id) }}"> {{ $subcategory->name }} </a> >
        <a href="{{ route('clothe.show', $clothe->id) }}"> {{ $clothe->name }} </a>
    </h2>
@endsection

@section('main')

    <section class="container mx-auto p-6 grid grid-cols-1 gap-8 sm:grid-cols-2">
           <!-- Sección izquierda: Información del artículo -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('Detalles de la prenda') }}</h3>
                   <!-- Información sobre el artículo -->
            <div class="mb-4">
            <p id="clothe_id" class="text-lg text-gray-700">Folio: <span class="font-semibold">{{ $clothe->id }}</span></p>
            <p id="clothe_name" class="text-lg text-gray-700">Prenda: <span class="font-semibold">{{ $clothe->name }}</span></p>
            <p id="clothe_description" class="text-lg text-gray-700"  > Detalles : <span class="font-semibold">{{$clothe->description}}</span></p>
            <p id="clothe_price" class="text-lg text-gray-700"> Precio : $<span class="font-semibold">{{$clothe->unit_price}}</span></p>

            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('Imágenes de la prenda') }}</h3>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 justify-items-center">
                @foreach ($photos as $photo)
                    <x-images :file_url="$photo->file_url" class="rounded-lg" />
                @endforeach
            </div>
            <!-- Colores disponibles -->
            <h3 class="text-lg font-semibold text-gray-800 my-4">{{ __('Colores disponibles') }}</h3>
            <div class="flex flex-wrap gap-2">
                @forelse ($colors as $color)
                    <div class="w-8 h-8 rounded-full border border-gray-300" style="background-color: {{ $color->name }}"></div>
                @empty
                    <p class="text-gray-600">No hay colores disponibles.</p>
                @endforelse
            </div>
            <h3 class="text-lg font-semibold text-gray-800 my-4">{{ __('Tallas disponibles') }}</h3>
            <select name="clothe_size" id="clothe_size" class="block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">--Seleccione Talla--</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>
            </div>
        </div>
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col items-start">
                <h3 class="text-xl font-bold text-gray-800 mb-4">{{ __('Acciones') }}</h3>

                <!-- Botón para apartar -->
                @auth
                    <button id="button" disabled class="w-full bg-green-600 text-white font-bold py-2 rounded-lg transition duration-300 hover:bg-green-700 cursor-pointer disabled:opacity-50">
                        Apartar
                    </button>
                @endauth

                <!-- Botón para iniciar sesión -->
                @guest
                    <a href="{{ route('login') }}" class="w-full bg-orange-500 text-white font-bold py-2 rounded-lg transition duration-300 hover:bg-orange-600 text-center">
                        Iniciar sesión para apartar
                    </a>
                @endguest

            </div>
    </section>
@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const sizeSelect = document.querySelector('#clothe_size');
        const button = document.querySelector('#button');
        let currentSelect;
        const MAX_CLOTHES = 6;

        //Listeners
        document.addEventListener('DOMContentLoaded', () =>{
            sizeSelect.addEventListener('change', buttonEnable);
            button.addEventListener('click', addClothe);

        })

        function buttonEnable(e){
            currentSelect = e.target.value;
            // Validate select
            if (currentSelect === '') {
                button.disabled = true;
            } else {
                button.disabled = false;
            }
        };

        // Add clothe to the cart to localStorage
        function addClothe() {
            // Obtener la URL completa de la imagen
            const imgElement = document.querySelector('img');
            const currentImage = imgElement ? imgElement.src : ''; // Usar valor vacío si no se encuentra la imagen
            const lastIndex = currentImage.lastIndexOf('.');
            const newImage = lastIndex !== -1 ? currentImage.substring(0, lastIndex) : ''; // Asegurarse de que newImage sea vacío si no se encuentra una extensión válida

            const clotheIdElement = document.querySelector('#clothe_id span');
            const clotheNameElement = document.querySelector('#clothe_name span');
            const sizeSelect = document.querySelector('#clothe_size');

            const cart = {
                id: clotheIdElement ? clotheIdElement.textContent : '',
                name: clotheNameElement ? clotheNameElement.textContent : '',
                image: newImage,
                size: sizeSelect ? sizeSelect.options[sizeSelect.selectedIndex].textContent : '',
                sizeId: sizeSelect ? sizeSelect.value : '',
                price: parseInt(document.querySelector('#clothe_price span').textContent) || 0,
                amount: 1
            };

            let cartItems = JSON.parse(localStorage.getItem('cart')) || [];

            // Verify if the clothe is on the cart
            const existItem = cartItems.findIndex(item => item.id === cart.id && item.size === cart.size);

            if (existItem !== -1) {
                //if the amount is less to 6
                if (cartItems[0].amount < MAX_CLOTHES) {
                    //sum amount
                    cartItems[0].amount++;
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Exceso de prendas!",
                        toast: true,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    return;
                }
            } else {
                // Verify if the clothe is on the cart and if the amount is less to 6
                if (cart.amount <= MAX_CLOTHES) {
                    cartItems.push(cart);
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Exceso de prendas!",
                        toast: true,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
            }

            // Keep on the new cart
            localStorage.setItem('cart', JSON.stringify(cartItems));

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Tu Prenda se agregó correctamente!",
                toast: true,
                showConfirmButton: false,
                timer: 1500
            });
        };
    </script>
@endpush
