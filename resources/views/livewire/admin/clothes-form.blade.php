<form wire:submit="store" novalidate>

    <x-input-label for="name" :value="__('Nombre de prenda')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.name')" />
    <x-text-input wire:model="clotheCreate.name" type="text" class="mt-1 block w-full" />


    <x-input-label for="description" :value="__('Descripción')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.description')" />
    <x-textarea id="description" wire:model="clotheCreate.description" type="text" class="mt-1 block w-full" />


    <x-input-label for="unit_price" :value="__('Precio unitario')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.unit_price')" />
    <x-text-input id="unit_price" wire:model="clotheCreate.unit_price" type="number" class="mt-1 block w-full" />

    <x-input-label for="unit_price" :value="__('Categorias')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.category')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.sub_category')" />

    <x-select wire:model="clotheCreate.category" wire:change='createSelect($event.target.value)' name="category">
        <option value="" selected>Seleccione una categoría</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </x-select>

    @if (!empty($subcategories))
        <x-select wire:model="clotheCreate.sub_category">
            <option value="" selected>Seleccione sub categoria</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
            @endforeach
        </x-select>
    @endif

    <x-input-label for="provider" :value="__('Proveedor')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.provider')" />
    <x-select wire:model="clotheCreate.provider"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:ring-blue-500 focus:border-blue-500 block">
        <option value="" selected>Selecciona un proveedor</option>
        @foreach ($providers as $provider)
            <option value="{{ $provider->id }}"> {{ $provider->name }} </option>
        @endforeach
    </x-select>

    {{--! Color --}}
    <x-input-label for="colorPicker" :value="__('Color/s')" />
    <div class="flex flex-wrap gap-4">
        @for ($i = 0; $i < $numInputsColor; $i++)
            <input type="color" id="colorPicker{{ $i }}"
                wire:model="clotheCreate.colors.{{ $i }}" class="rounded-full w-10 h-8">
        @endfor
    </div>

    <x-button class="bg-green-500" type="button" wire:click="addInputColor">Agregar Color</x-button>
    @if ($numInputsColor >= 1)
        <x-button class="bg-red-500" type="button" wire:click="deleteInputColor">Eliminar Color</x-button>
    @endif

    <x-input-label for="file" :value="__('Añadir imagen/es')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.file')" />

    <input type="file" wire:model="clotheCreate.file" accept=".jpg, .jpeg, .png" id="file-input" multiple class="block p-2 text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400 my-2">

<div class="grid grid-cols-1 items-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    @if ($clotheCreate->file)
        @foreach ($clotheCreate->file as $index => $image)
    <div wire:key='{{$index +1}}' class="flex flex-col gap-2">
            <div class="">
                <span class="font-bold">Imagen: {{ $index +1 }}</span>
            </div>
            <div class="mb-4">
                <img class="w-24 h-24" src="{{ $image->temporaryUrl() }}" alt="Image{{ $index }}">
            </div>
            <div class="" wire:click="deleteImage({{ $index }})">
                <p class="bg-red-600 inline-block text-white uppercase text-1xl px-4 py-2 font-bold rounded-lg cursor-pointer">Eliminar</p>
            </div>
    </div>
        @endforeach
    @endif
</div>

    <div wire:loading wire:target="clotheCreate.file" class="">
         <svg aria-hidden="true" class="inline w-20 h-20 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
        </svg>
    </div>

    <x-input-label for="provider" :value="__('Tallas')" />
    <x-input-error class="mt-2" :messages="$errors->get('clotheCreate.sizes')" />

    @foreach ($sizes as $size)
        <div class="p-2">
            <input class="form-checkbox cursor-pointer ms-2 h-6 w-6 text-red-900" type="checkbox"
                wire:model="clotheCreate.sizes" value="{{ $size->id }}" />
            <label>{{ $size->name }} :</label>
            <label>{{ $size->description }}</label>
        </div>
    @endforeach


    <x-button>{{ __('Crear') }}</x-button>

</form>
