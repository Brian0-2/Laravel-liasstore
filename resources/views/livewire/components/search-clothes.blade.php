<div class="bg-gray-100 mx-auto my-8 p-5">
    <div class="flex flex-col gap-4 md:flex-row sm:px-6 lg:px-8">
        <!-- Primer div con formulario -->
        <div class="w-full md:w-1/3">
            <div class="bg-gray-200 p-4 rounded-lg sticky top-10">
                <form wire:change.prevent="submitForm">
                    <p class="font-bold bg-gray-300 p-2 rounded-lg">Filtrar por</p>
                    <div>
                        <label class="text-lg font-semibold mt-4">Categoría</label>
                        @foreach ($categories as $category)
                            <div class="p-3 flex items-center justify-between">
                                <label for="category{{$category->id}}">{{$category->name}}</label>
                                <input class="form-checkbox cursor-pointer ms-2 h-6 w-6 text-red-900" type="checkbox"
                                    id="category{{$category->id}}" name="category{{$category->id}}" wire:model="selectedCategories" value="{{$category->id}}">
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full md:w-2/3">
            <div class="bg-gray-200 overflow-y-auto shadow-sm rounded-lg">
                <div class="p-4">
                    <div class="p-4">
                        <div class="relative">
                            <input wire:model.live='search' type="text" class="block mt-1 w-full px-4 py-2 rounded-lg border-gray-300 bg-white focus:ring-indigo-500 focus:border-indigo-500" placeholder="Buscar por nombre de prenda">
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M12.95 14.95a8 8 0 111.414-1.414l3.293 3.293a1 1 0 11-1.414 1.414l-3.293-3.293zM10 16a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <ul class="container mx-auto grid grid-cols-1 gap-6 justify-items-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 p-5">
                        @forelse ($clothes as $clothe)
                            <div wire:lazy wire:key='clothe-{{$clothe->id}}' class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">

                                <div class="mb-4">
                                    <x-images :file_url="$clothe->photo" />
                                </div>

                                <p class="text-lg font-semibold text-gray-800 mb-2">{{ $clothe->clothe }}</p>
                                <p class="text-gray-600">Precio: ${{ $clothe->price }}</p>
                                <div class="flex justify-evenly gap-2 mb-4">
                                    @foreach($clothe->sizes as $size)
                                        <span class="bg-gray-200 px-3 py-1 rounded-lg text-gray-700">{{ $size->name }}</span>
                                    @endforeach
                                </div>
                                <x-link href="{{ route('clothe.show', $clothe->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out block w-full text-center">Detalles</x-link>
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
