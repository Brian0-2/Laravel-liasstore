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
    <section class="grid grid-cols-1 gap-4  justify-items-center sm:grid-cols-2 p-5">
        <div class="">
            <x-input-label :value="__('Prenda')" />
            <x-input-label id="clothe_id" >
                Folio: <span>{{$clothe -> id}}</span>
            </x-input-label>
            <x-input-label id="clothe_name" >
                Prenda: <span>{{$clothe -> name }}</span>
            </x-input-label>
            <x-input-label id="clothe_description" >
                Detalles : <span>{{$clothe->description}}</span>
            </x-input-label>
            <x-input-label id="clothe_price" >
                Precio : $<span>{{$clothe->unit_price}}</span>
            </x-input-label>
            <x-input-label :value="__('Imagenes de prenda')" />
            @foreach ($photos as $photo)
                <x-images :file_url="$photo->file_url" />
            @endforeach
            <x-input-label :value="__('Colores Disponibles')" />
            @forelse ($colors as $color)
                <div class="w-8 h-8 rounded-full border-4 border-black" style="background-color: {{ $color->name }}"></div>
            @empty
                <p>No hay colores disponibles.</p>
            @endforelse
            <x-input-label for="clothe_size" :value="__('Tallas disponibles')" />
            <select name="clothe_size" id="clothe_size">
                <option value="">--Seleccione Talla--</option>
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="">
            <x-input-label for="name" :value="__('Acciones')" />
            @auth
                <button id="button" disabled class="bg-green-600 p-2 font-bold rounded-lg enabled:cursor-pointer disabled:opacity-10">Apartar</button>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="bg-orange-300 p-2 font-bold rounded-lg cursor-pointer">Inisiar Sesion
                    para poder apartar</a>
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
            const currentImage = document.querySelector('img').src;
            const lastIndex = currentImage.lastIndexOf('.');
            const newImage = currentImage.substring(0, lastIndex);

            const cart = {
                id: document.querySelector('#clothe_id span').textContent,
                name: document.querySelector('#clothe_name span').textContent,
                image: newImage,
                size: document.querySelector('#clothe_size').options[sizeSelect.selectedIndex].textContent,
                sizeId: document.querySelector('#clothe_size').value,
                price: parseInt(document.querySelector('#clothe_price span').textContent),
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
