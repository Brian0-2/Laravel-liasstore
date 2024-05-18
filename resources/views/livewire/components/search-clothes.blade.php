<div class="p-5">
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
                    <div class="p-4">
                        <x-text-input wire:model.live='search' type="text" class="block mt-1 w-full"
                            placeholder="Buscar por nombre de prenda" />
                    </div>
                    <ul class="container mx-auto grid grid-cols-1 gap-6 justify-items-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-5">
                        @forelse ($clothes as $clothe)
                            <div wire:lazy wire:key='clothe-{{$clothe-> id}}' class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">

                                <div class="mb-4">
                                    <x-images :file_url="$clothe->photo" />
                                </div>

                                <p class="text-lg font-semibold text-gray-800 mb-2">{{ $clothe->clothe }}</p>
                                <p>$ {{ $clothe->price }}</p>
                                <div class="flex justify-evenly gap-2 mb-4">
                                @foreach($clothe->sizes as $size)
                                    <p class="bg-gray-200 px-3 py-1 rounded-lg text-gray-700">{{ $size->name }}</p>
                                @endforeach
                                </div>
                                <x-link href="{{ route('clothe.show', $clothe->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">Detalles</x-link>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">No hay resultados...</p>
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
