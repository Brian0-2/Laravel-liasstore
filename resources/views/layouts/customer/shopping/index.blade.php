@extends('layouts.customer.guest')

@section('title', 'Lias Store | Carrito')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fa-solid fa-cart-shopping"></i>
        {{ __('Cart') }}
    </h2>
@endsection

@section('main')
    <div class="p-5">
        <h2 class="cart-status text-center bg-slate-400 rounded-lg mb-2"></h2>
        <ul class="cart">

        </ul>
    </div>
@endsection

@push('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const cartList = document.querySelector('.cart');
        const MAX_CLOTHES = 6;
        const MIN_CLOTHES = 1;

        document.addEventListener('DOMContentLoaded', () => {
            let currentCart = localStorage.getItem('cart');
            currentCart = JSON.parse(currentCart);
            checkCartEmpty();

            currentCart.forEach((cart, index) => {
                const listDetails = document.createElement('LI');
                listDetails.classList.add('flex');

                listDetails.innerHTML = `
            <div class="">
                <picture>
                    <source srcset="${cart.image}.webp" type="image/webp">
                    <source srcset="${cart.image}.png" type="image/png">
                    <img loading="lazy" width="200px" height="300px" src="${cart.image}.png" alt="imagen ${cart.image}">
                </picture>
                <p>Precio: $<span>${cart.price}</span></p>
                <p>Talla seleccionada: <span>${cart.size}</span></p>
                <button class="addClothe${index}">Sumar</button>
                <p>${cart.amount}</p>
                <button class="removeClothe${index}">Restar</button>
                <button class="deleteClothe${index}">Eliminar</button>
            </div>
            <div class="">
            </div>
        `;
                cartList.appendChild(listDetails);

                let addClothe = document.querySelector(`.addClothe${index}`);
                addClothe.addEventListener('click', () => incrementAmount(currentCart, cart, index));

                let removeClothe = document.querySelector(`.removeClothe${index}`);
                removeClothe.addEventListener('click', () => decrementAmount(currentCart, cart, index));

                let deleteClothe = document.querySelector(`.deleteClothe${index}`);
                deleteClothe.addEventListener('click', () => dropCLothe(currentCart, cart, index));

            });

        });

        function incrementAmount(currentCart, cart, index) {
            if (cart.amount < MAX_CLOTHES) {
                cart.amount++;
                updateAmountDisplay(cart, index);
                updateLocalStorage(currentCart);
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Exceso de prendas!",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        }

        function decrementAmount(currentCart, cart, index) {
            if (cart.amount > MIN_CLOTHES) {
                cart.amount--; // Decrementar la cantidad en el objeto cart
                updateAmountDisplay(cart, index);
                updateLocalStorage(currentCart);
            } else {
                dropCLothe(currentCart, cart, index);
            }
        }

        function updateAmountDisplay(cart, index) {
            const amountElement = document.querySelector(`.addClothe${index}`).nextElementSibling;
            amountElement.textContent = cart.amount;
        }

        function dropCLothe(currentCart, cart, index) {
            Swal.fire({
                title: "Estas seguro?",
                text: "Esta prenda se borrara de tu carrito!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "si,Borrar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Borrada correctamente",
                        text: "Tu prenda ha sido borrada de tu carrito!",
                        icon: "success"
                    });
                    currentCart.splice(index, 1);
                    updateLocalStorage(currentCart);

                    const cartItem = document.querySelector(`.addClothe${index}`).parentElement.parentElement;
                    cartItem.remove();
                    checkCartEmpty();
                }
            });
        }

        function checkCartEmpty() {
            let cartStatus = document.querySelector('.cart-status');

            let currentCart = localStorage.getItem('cart');
            currentCart = JSON.parse(currentCart);
            if (!currentCart || currentCart.length === 0) {
                cartStatus.textContent = "No articulos en el carrito"

            }else{
                cartStatus.textContent = "Articulos en el Carrito"
            }
        }

        function updateLocalStorage(currentCart) {
            localStorage.setItem('cart', JSON.stringify(currentCart));
        }
    </script>
@endpush
