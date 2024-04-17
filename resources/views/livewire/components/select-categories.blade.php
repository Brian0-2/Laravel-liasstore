<div>
    <x-select wire:model="category" wire:change='createSelect($event.target.value)' name="category">
        @foreach ($categories as $category)
            <option
            {{ $category->id === $category ? 'selected' : '' }}
            value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </x-select>

        <x-select wire:model="sub_category" name="sub_category_id">
            @foreach ($subcategories as $subcategory)
                <option
                {{ $subcategory -> id === $subcategoryId ? 'selected' : '' }}
                value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
            @endforeach
        </x-select>
</div>
