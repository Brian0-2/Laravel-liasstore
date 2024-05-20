<div class="container mx-auto py-8">

    <div class="mb-4 w-full flex justify-center space-x-4">
        <label><input type="radio" wire:model="orderState" wire:click="filterByOrderState('pending')" value="pending">
            Pendiente</label>
        <label><input type="radio" wire:model="orderState" wire:click="filterByOrderState('complete')" value="complete">
            Completo</label>
    </div>

    @if ($orders->count())

    @forelse ($orders as $order)
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6" wire:key='order-{{$order->id}}'>
        <p class="text-xl font-semibold mb-2">Folio del pedido: {{$order->id}}</p>
        <p>Estado: <span class="{{ $order -> state === 'pending' ? 'text-red-500' : 'text-green-500' }}">{{ $order->state === 'pending' ? 'Pendiente' : 'Completo' }} </span></p>
        <p class="text-gray-700 mb-2">Total: ${{ $order->total }}</p>
        <p class="text-gray-700 mb-2">Ordenada el día: {{$order->created_at->toFormattedDateString()}}</p>
        <button wire:click="showOrderDetails('{{ $order->id }}')"
            class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">
            Detalles
        </button>
    </div>
    @empty
    <p class="text-center font-bold">No has apartado prendas aún... <a class="text-blue-500"
            href="{{ route('index') }}">Elegir prendas</a></p>
    @endforelse

    <div class="p-4">
        {{ $orders->links() }}
    </div>

    <x-dialog-modal wire:model="open">
        <x-slot name="title">
            <p class="text-2xl font-semibold">Ver detalle</p>
        </x-slot>
        <x-slot name="content">
            <section>
                @if ($order)
                <p class="text-gray-700 mb-2">Folio: {{ $order->id }}</p>
                <p>Estado: <span class="{{ $order -> state === 'pending' ? 'text-red-500' : 'text-green-500' }}">{{ $order->state === 'pending' ? 'Pendiente' : 'Completo' }} </span></p>
                <p class="text-gray-700 mb-2">Total: ${{ $order->total }}</p>
                <p class="text-gray-700 mb-2">Ordenada el día: {{ $order->created_at->toFormattedDateString() }}</p>
                <p>Total de piezas: {{ $this->total }}</p>

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
                @endif
            </section>
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="$set('open', false)">
                Cerrar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
    @else
    <p class="text-center">No hay pedidos aun...<a href="{{ route('index') }}" class="text-blue-500">Elegir prendas</a></p>
    @endif
</div>
