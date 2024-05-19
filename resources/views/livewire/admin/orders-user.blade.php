<div class="p-5">
    <x-link :href="route('orders.index')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold p-2 rounded-md transition-colors duration-300">
        Volver
    </x-link>
    @forelse ($orders as $order )
    <section class="flex justify-between items-center shadow-lg p-5">
        <div class="">
            <p>Folio: {{ $order->id }}</p>
            <p>Estado: {{ $order->state === 'pending' ? 'Pendiente' : 'Completo' }}</p>
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
                <p class="text-gray-700 mb-2">Folio: {{ $order->id }}</p>
                <p class="text-gray-700 mb-2">Estado: {{ $order->state === 'pending' ? 'Pendiente' : 'Completo' }}</p>
                <p class="text-gray-700 mb-2">Total: ${{ $order->total }}</p>
                <p class="text-gray-700 mb-2">Ordenada el día: {{ $order->created_at->toFormattedDateString() }}</p>

                @if ($clothes && $clothes->count() > 0)
                    @foreach ($clothes->clothes as $clothe)
                        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                            <p class="text-xl font-semibold mb-2">{{ $clothe->name }}</p>
                            <p class="text-gray-700 mb-2">{{ $clothe->description }}</p>
                            <p class="text-gray-700 mb-2">Precio: ${{ $clothe->total }}</p>
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
