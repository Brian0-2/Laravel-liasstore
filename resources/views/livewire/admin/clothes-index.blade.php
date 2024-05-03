<div class="py-5">
    <div class="flex flex-col gap-4 container mx-auto md:flex-row sm:px-6 lg:px-8">
        <!-- Primer div con formulario -->
        <div class="">
            <div class="bg-slate-300 p-4 rounded-lg sticky top-10">
                <form wire:change.prevent="submitForm">
                    <p class="font-bold bg-slate-400 p-2 rounded-lg">Filtrar por</p>
                    <div>
                        <label class="text-lg font-semibold" for="">Categoria</label>
                        @foreach ($categories as $category )
                        <div class="p-3 flex justify-between">
                            <label for="">{{$category -> name}}</label>
                            <input class="form-checkbox cursor-pointer ms-2 h-6 w-6 text-red-900" type="checkbox"
                                name="men" wire:model="selectedCategories" value="{{$category -> id}}">
                        </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full">
            <div class="bg-slate-300 overflow-y-auto shadow-sm rounded-lg">
                <div class="p-4">
                    <x-link :href="route('clothes.create')" class="bg-red-400 p-3 text-white font-bold">
                        Crear Prenda
                    </x-link>
                    <div class="p-4">
                        <x-text-input wire:model.live='search' type="text" class="block mt-1 w-full"
                            placeholder="Buscar por nombre de prenda" />
                    </div>
                    <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        @forelse ($clothes as $clothe)
                            <li wire:lazy wire:key='clothe-{{$clothe-> id}}' class=" flex flex-col items-center">

                                <x-images :file_url="$clothe -> photo" />
                                <p>{{ $clothe->clothe }}</p>
                                <p>$ {{ $clothe->price }}</p>
                                <div class="flex">
                                    <a href="{{ route('clothes.edit', $clothe->id) }}"
                                        class="text-white text-xs bg-gradient-to-r bg-green-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none   uppercase shadow-lg shadow-lime-500/50 rounded-lg px-5 py-2.5 text-center me-2 mb-2">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('clothes.destroy', $clothe->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <x-danger-button
                                            class="text-white text-xs bg-gradient-to-r to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none  shadow-lg shadow-red-500/50  rounded-lg  px-5 py-2.5 text-center me-2 mb-2">
                                            {{ __('Borrar') }}
                                        </x-danger-button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <p class="text-center font-bold">No se encontraron registros</p>
                        @endforelse
                    </ul>
                </div>
                <div class="p-4">
                    {{ $clothes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
