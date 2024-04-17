<div>
    <div class="flex flex-wrap gap-4">
        @for ($i = 0; $i < $numInputsColor; $i++)
            <input
            class="rounded-full w-10 h-8"
            type="color"
            id="colorPicker{{ $i }}"
            name="colors[]"
            >
        @endfor
    </div>

    <x-button class="bg-green-500" type="button" wire:click="addInputColor">Agregar Color</x-button>
    @if ($numInputsColor >= 1)
        <x-button class="bg-red-500" type="button" wire:click="deleteInputColor">Eliminar Color</x-button>
    @endif

</div>
