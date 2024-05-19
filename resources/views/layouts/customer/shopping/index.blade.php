@extends('layouts.customer.guest')

@section('title', 'Lias Store | Carrito')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-cart-shopping"></i>
        {{ __('Carrito') }}
    </h2>
@endsection

@section('main')
    <section class="p-5 bg-gray-100 min-h-screen">
        <h2 class="cart-status text-center bg-black rounded-lg mb-4 py-2 text-white font-bold"></h2>
        <div class="flex current-cart flex-col md:flex-row gap-4">
            <ul class="cart grid grid-cols-1 gap-4 items-center justify-items-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            </ul>
            <div class="summary bg-white p-6 rounded-lg shadow-lg md:w-1/3 lg:w-1/4 md:sticky md:top-10">
                <h3 class="text-lg font-bold mb-4">Resumen de la compra</h3>
                <p class="mb-2">Prendas: <span id="totalParts" class="font-semibold"></span></p>
                <p class="mb-2">Total: $<span id="total" class="font-semibold"></span></p>
                <input id="token" type="hidden" value="{{ csrf_token() }}">

                <x-button id="button" class="mt-4 w-full bg-blue-500 hover:bg-blue-700 text-white py-2 rounded-md">Apartar prendas</x-button>
            </div>
        </div>
    </section>
@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const MAX_CLOTHES = 6;
        const MIN_CLOTHES = 1;

        document.addEventListener('DOMContentLoaded', () => {
            let currentCart = JSON.parse(localStorage.getItem('cart')) || [];

            updateTotalAndSummary(currentCart);
            checkCartEmpty();
            totalParts(currentCart);

            currentCart.forEach((cart, index) => {
                const listDetails = document.createElement('LI');
                listDetails.classList.add('flex', 'flex-col', 'items-center', 'justify-between', 'bg-white', 'p-4', 'rounded-lg', 'shadow-md', 'transition', 'transform', 'hover:scale-105', 'space-y-4');

                listDetails.innerHTML = `
                <div class="flex flex-col items-center">
                    <picture>
                        <source srcset="${cart.image}.webp" type="image/webp">
                        <source srcset="${cart.image}.png" type="image/png">
                        <img loading="lazy" class="w-32 h-48 object-cover rounded-md shadow-md" src="${cart.image}.png" alt="imagen ${cart.image}">
                    </picture>
                    <div class="mt-2 text-center">
                        <p class="text-lg font-semibold text-gray-800">Precio: $<span>${cart.price}</span></p>
                        <p class="text-sm text-gray-600">Talla seleccionada: <span>${cart.size}</span></p>
                    </div>
                </div>
                <div class="flex flex-col items-center mt-4">
                    <p class="text-center font-bold mb-2 text-gray-700">Acciones</p>
                    <div class="flex items-center space-x-2">
                        <button class="addClothe${index} border border-gray-300 text-black px-2 py-1 rounded-md">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <p class="text-lg font-semibold text-gray-800">${cart.amount}</p>
                        <button class="removeClothe${index} border border-gray-300 text-black px-2 py-1 rounded-md">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <button class="deleteClothe${index} bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600">Eliminar</button>
                    </div>
                </div>
                `;

                document.querySelector('.cart').appendChild(listDetails);

                let addClothe = document.querySelector(`.addClothe${index}`);
                addClothe.addEventListener('click', () => incrementAmount(currentCart, cart, index));

                let removeClothe = document.querySelector(`.removeClothe${index}`);
                removeClothe.addEventListener('click', () => decrementAmount(currentCart, cart, index));

                let deleteClothe = document.querySelector(`.deleteClothe${index}`);
                deleteClothe.addEventListener('click', () => dropClothe(currentCart, cart, index));
            });

            document.querySelector('#button').addEventListener('click', () => addOrder(currentCart));
        });

        function incrementAmount(currentCart, cart, index) {
            if (cart.amount < MAX_CLOTHES) {
                cart.amount++;
                updateAmountDisplay(cart, index);
                updateLocalStorage(currentCart);
                updateTotalAndSummary(currentCart);
                totalParts(currentCart);
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Exceso de prendas!",
                    toast: true,
                    showConfirmButton: false,
                    timer: 2000
                });
                return;
            }
        }

        function decrementAmount(currentCart, cart, index) {
            if (cart.amount > MIN_CLOTHES) {
                cart.amount--;
                updateAmountDisplay(cart, index);
                updateLocalStorage(currentCart);
                updateTotalAndSummary(currentCart);
                totalParts(currentCart);
            } else {
                dropClothe(currentCart, cart, index);
            }
        }

        function updateAmountDisplay(cart, index) {
            const amountElement = document.querySelector(`.addClothe${index}`).nextElementSibling;
            amountElement.textContent = cart.amount;
        }

        function dropClothe(currentCart, cart, index) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta prenda se borrará de tu carrito!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sí, Borrar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Borrada correctamente",
                        text: "Tu prenda ha sido borrada de tu carrito!",
                        toast: true,
                        icon: "success"
                    });
                    currentCart.splice(index, 1);
                    updateLocalStorage(currentCart);

                    const cartItem = document.querySelector(`.addClothe${index}`).parentElement.parentElement;
                    cartItem.remove();
                    checkCartEmpty();
                    updateTotalAndSummary(currentCart);
                    totalParts(currentCart);
                }
            });
        }

        function checkCartEmpty() {
            let currentCart = JSON.parse(localStorage.getItem('cart')) || [];

            if (!currentCart || currentCart.length === 0) {
                document.querySelector('.cart-status').textContent = "No hay artículos en el carrito";
                document.querySelector('.current-cart').classList.add('hidden');
            } else {
                document.querySelector('.cart-status').textContent = `Artículos en el carrito: ${currentCart.length}`;
                document.querySelector('.current-cart').classList.remove('hidden');
            }
        }

        function updateLocalStorage(currentCart) {
            localStorage.setItem('cart', JSON.stringify(currentCart));
        }

        function updateTotalAndSummary(currentCart) {
            const total = currentCart.reduce((total, item) => total + item.price * item.amount, 0);
            document.querySelector('#total').textContent = total;
        }

        function totalParts(currentCart) {
            const totalParts = currentCart.reduce((total, item) => total + item.amount, 0);
            document.querySelector('#totalParts').textContent = totalParts;
        }

        async function addOrder(currentCart) {
            const total = currentCart.reduce((total, item) => total + item.price * item.amount, 0);

            const confirmation = await Swal.fire({
                title: "¿Estás seguro?",
                text: `Se creará tu pedido de inmediato por: $${total}`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sí, Pedir!"
            });

            if (confirmation.isConfirmed) {
                const dataToSend = {
                    cart: currentCart,
                    total: total
                };

                const dataItem = JSON.stringify(dataToSend);
                const token = document.querySelector('#token').value;

                try {
                    const url = '/order';
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                        },
                        credentials: 'include',
                        body: dataItem,
                    });

                    const resultData = await response.json();

                    Swal.fire({
                        title: resultData.message,
                        toast: true,
                        icon: "success"
                    });

                    // localStorage.removeItem('cart');
                    // checkCartEmpty();
                } catch (error) {
                    console.error('Error adding order:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un error al procesar tu pedido.',
                        icon: 'error'
                    });
                }
            }
        }
    </script>
@endpush
