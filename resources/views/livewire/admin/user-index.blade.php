<div class="p-5">
    <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
        <input wire:model="search_id" type="text"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Buscar por ID">
        <button wire:click="searchById"
            class="text-white absolute end-2.5 bottom-2.5 bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">Buscar
            por ID</button>
    </div>

    <div class="p-4">
        <input wire:model.live='search' type="text"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Buscar por nombre o correo@">
    </div>
    <div class="flex-auto block py-8 pt-6 px-9">
        @if ($users->count())
            <table class="w-full my-0 align-middle text-dark border-neutral-200">
                <tbody>

                    <tr class="bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 border-dashed last:border-b-0">
                        <th class="">ID</th>
                        <th class="">Nombre</th>
                        <th class="">Correo</th>
                        <th class="">Roles</th>
                        <th></th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr wire:lazy class="{{ $key % 2 == 0 ? 'even:bg-gray-100' : 'odd:bg-gray-200' }} border-t">
                            <td class="">{{ $user->id }}</td>
                            <td class="">{{ $user->name }}</td>
                            <td class="">{{ $user->email }}</td>
                            <td class="">
                                @forelse ($user->roles as $role)
                                    <p class="font-bold">{{ $role->name }}</p>
                                @empty
                                    <p class="text-center">-</p>
                                @endforelse
                            </td>
                            <td class="flex justify-end">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="text-white bg-gradient-to-r bg-green-500  uppercase dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Editar</a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <x-danger-button
                                        class="text-white bg-gradient-to-r  to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none  dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                        {{ __('Borrar') }}
                                    </x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hubo resultados...</p>
        @endif
    </div>

    <div class="">
        {{ $users->links() }}
    </div>

</div>
