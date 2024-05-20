<div class="p-5">
    <x-link :href="route('orders.index')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-md transition-colors duration-300">
        Volver
    </x-link>
        @forelse ($orders as $order )
        <section class="flex justify-between items-center shadow-lg p-5">
            <div class="">
                <p>Folio: {{ $order->id }}</p>
                <p>Estado: <span class="{{ $order -> state === 'pending' ? 'text-red-500' : 'text-green-500' }}">{{ $order->state === 'pending' ? 'Pendiente' : 'Completo' }} </span></p>
                <p>Total: ${{ $order->total }}</p>
                <p>Ordenada el día: {{ $order->created_at->toFormattedDateString() }}</p>
            </div>
            <x-button wire:click="showOrderDetails('{{ $order->id }}')" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">
                Detalles
            </x-button>
        </section>

        @empty
        <p>No tiene pedidos...</p>
    @endforelse

    <div class="p-4">
        {{ $orders -> links() }}
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <p class="text-2xl font-semibold">Ver detalle</p>
        </x-slot>
        <x-slot name="content">
            <section>
                <div class="flex justify-evenly items-center">
                    <div class="">
                        <p class="text-gray-700 mb-2">Folio: {{ $order->id }}</p>
                        <p>Estado: <span class="{{ $order -> state === 'pending' ? 'text-red-500' : 'text-green-500' }}">{{ $order->state === 'pending' ? 'Pendiente' : 'Completo' }} </span></p>
                        <p class="text-gray-700 mb-2">Total: ${{ $order->total }}</p>
                        <p class="text-gray-700 mb-2">Ordenada el día: {{ $order->created_at->toFormattedDateString() }}</p>
                        <p>Total de piezas: {{$this->total}}</p>
                        </div>
                    <div class="my-2">
                        <x-button wire:click="toggleOrderState('{{ $order->id }}')">
                            Cambiar estado
                        </x-button>
                        <button wire:click="$dispatch('deleteOrder',{{ $order->id }})">
                            Eliminar
                        </button>
                    </div>
                </div>

                @if ($clothes && $clothes->count() > 0)
                @foreach ($clothes as $index => $clothe)
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6" wire:key='$clothe -> id'>
                        <p class="text-xl font-semibold mb-2">{{ $clothe->name }}</p>
                        <p class="text-gray-700 mb-2">{{ $clothe->description }}</p>
                        <p class="text-gray-700 mb-2">Precio: ${{ $clothe->unit_price }}</p>
                        <p>Cantidad: {{ $clothe->orderClothes[0] -> amount}}</p>
                        <p>Talla: {{ $clothe->sizes[0] -> name }}</p>

                            <div class="grid grid-cols-2 gap-4">
                                @foreach ($clothe->photos as $photo)
                                    <x-images :file_url="$photo->file_url" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-700">No hay prendas asociadas a este pedido.</p>
                @endif
            </section>

        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('open', false)">
                Cerrar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>

@push('javascript')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('deleteOrder', (orderId) => {
            Swal.fire({
                title: '¿Eliminar Pedido?',
                text: "Una Pedido eliminado no se puede recuperar:(",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ELiminar vacante
                    @this.call('deleteOrder', orderId);
                    Swal.fire(
                        'Se eliminó la Vacante',
                        'Eliminado correctamente',
                        'success'
                    )
                }
            })

        });
    });
</script>
@endpush


