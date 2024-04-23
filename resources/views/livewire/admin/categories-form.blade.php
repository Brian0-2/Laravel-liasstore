<div>
    <form wire:submit='save' novalidate enctype="multipart/form-data">
        <x-input-label for="name" :value="__('Nombre')" />
        <x-text-input id="name" wire:model="name" type="text" class="mt-1 block w-full" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />

        <div class="p-2">
            <x-input-label for="name" :value="__('Sub Categoria')" />
            <div class="my-2">
                @for ($i = 0; $i < $input; $i++)
                    <p class="font-bold">Sub categoria: <span class="font-normal">{{ $i + 1 }}</span></p>
                    <x-text-input type="text" id="input{{ $i }}"
                        wire:model="subcategory.{{ $i }}" class="rounded-full w-full space-y-2" />
                    <x-input-label for="name" :value="__('Agrega imagen')" />
                    <input type="file" accept=".jpg, .jpeg, .png" wire:model='image'
                        class="block p-2 text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 my-2">
                     <x-input-error class="mt-2" :messages="$errors->get('image')" />
                @endfor
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('subcategory')" />
            <x-button class="bg-green-500" type="button" wire:click="addInputColor">Agregar sub categoria</x-button>
            @if ($input >= 1)
                <x-button class="bg-red-500" type="button" wire:click="deleteInputColor">Eliminar</x-button>
            @endif
        </div>
        <x-primary-button>{{ __('Create') }}</x-primary-button>
    </form>
</div>
