<div>
    <p>Hi desde orders</p>
    <div class="mb-4">
        <div class="relative">
            <input wire:model="search_id" type="text"
                class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Buscar por ID">
            <button wire:click="searchById"
                class="text-white absolute end-2.5 bottom-2.5 bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 ">Buscar
                por ID</button>
        </div>
    </div>
    <div class="">
        <input wire:model.live='search' type="text"
            class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Buscar por nombre o correo@">
    </div>
    <input type="radio" wire:model="orderState" wire:click="filterByOrderState('pending')" value="pending"> Pendiente
    <input type="radio" wire:model="orderState" wire:click="filterByOrderState('complete')" value="complete"> Completo

    @forelse ($users as $user )
    <div class=" flex justify-between space-y-2">
        <p>{{$user -> name}}</p>
        <x-button wire:click="showOrderDetails('{{ $user->id }}')" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition duration-300 ease-in-out">
            Detalles
        </x-button>
    </div>
        @empty
        <p>No se encontraron resultados...</p>
    @endforelse
    <div class="">

    {{ $users->links() }}
    </div>
</div>
