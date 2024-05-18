<div>
    @forelse ($orders as $order )
            <div class="shadow-lg p-5" wire:key='order-{{$order -> id}}'>
                <p>Folio del pedido: {{$order -> id}}</p>
                <p>Estado: {{$order -> state === 'pending' ? 'Pendiente' : ''}}</p>
                <p>Total: ${{ $order -> total }}</p>
                <p>Ordenada el dia : {{$order -> created_at -> toFormattedDateString()}}</p>
                <x-button wire:click="showOrderDetails('{{ $order->id }}')" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">
                    Detalles
                </x-button>
            </div>
        @empty
            <p class="text-center font-bold">No has apartado prendas aun... <a class="text-blue-500" href="{{ route('index') }}">Elegir prendas</a></p>
        @endforelse

        <x-dialog-modal wire:model="open">
            <x-slot name="title">
                Ver detalle
            </x-slot>
            <x-slot name="content">
                <section>
                    <p>Folio: {{ $order->id }}</p>
                    <p>Estado: {{ $order->state === 'pending' ? 'Pendiente' : '' }}</p>
                    <p>Total: ${{ $order->total }}</p>
                    <p>Ordenada el día: {{ $order->created_at->toFormattedDateString() }}</p>

                    @if ($clothes && $clothes->count() > 0)
                        @foreach ($clothes->clothes as $clothe)
                            <div>
                                <p>{{ $clothe->name }}</p>
                                <p>{{ $clothe->description }}</p>
                                <p>Price: ${{ $clothe->unit_price }}</p>

                                <div>
                                    @foreach ($clothe->photos as $photo)
                                        <x-images :file_url="$photo->file_url" />
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No hay prendas asociadas a este pedido.</p>
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
