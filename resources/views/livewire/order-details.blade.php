<div class="container mx-auto py-8">
    @forelse ($orders as $order)
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6" wire:key='order-{{$order->id}}'>
            <p class="text-xl font-semibold mb-2">Folio del pedido: {{$order->id}}</p>
            <p class="text-gray-700 mb-2">Estado: {{$order->state === 'pending' ? 'Pendiente' : ''}}</p>
            <p class="text-gray-700 mb-2">Total: ${{ $order->total }}</p>
            <p class="text-gray-700 mb-2">Ordenada el día: {{$order->created_at->toFormattedDateString()}}</p>
            <button wire:click="showOrderDetails('{{ $order->id }}')" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">
                Detalles
            </button>
        </div>
    @empty
        <p class="text-center font-bold">No has apartado prendas aún... <a class="text-blue-500" href="{{ route('index') }}">Elegir prendas</a></p>
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
                            <p class="text-gray-700 mb-2">Precio: ${{ $clothe->unit_price }}</p>
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
