<div class="p-5 flex flex-col items-center">
    <div class="mb-4 w-full">
        <div class="relative">
            <input wire:model="search_id" type="text"
                class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Buscar por ID">
            <button wire:click="searchById"
                class="absolute right-4 bottom-4 bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 text-white">Buscar
                por ID</button>
        </div>
    </div>
    <div class="mb-4 w-full">
        <input wire:model.live='search' type="text"
            class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Buscar por nombre o correo@">
    </div>

    <div class="mb-4 w-full flex justify-center space-x-4">
        <label><input type="radio" wire:model="orderState" wire:click="filterByOrderState('pending')" value="pending">
            Pendiente</label>
        <label><input type="radio" wire:model="orderState" wire:click="filterByOrderState('complete')" value="complete">
            Completo</label>
    </div>

    <div class="overflow-x-auto w-full">
        <table class="w-full my-0 align-middle text-dark border-neutral-200">
            <thead>
                <tr class="bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 border-dashed last:border-b-0">
                    <th class="px-6 py-3 text-center">ID</th>
                    <th class="px-6 py-3 text-center">Nombre</th>
                    <th class="px-6 py-3 text-center">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user )
                <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200' }}">
                    <td class="px-6 py-4 text-center">{{ $user -> id }}</td>
                    <td class="px-6 py-4 text-center">{{ $user -> name }}</td>
                    <td class="px-6 py-4 text-center">
                        <x-link href="{{route('orders.show', $user -> id)}}"
                            class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">
                            Ver ordenes
                        </x-link>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center">No se encontraron resultados...</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 w-full flex justify-center">
        {{ $users->links() }}
    </div>
</div>
