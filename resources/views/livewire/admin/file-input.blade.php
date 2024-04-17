<div>
    <input
        type="file"
        wire:model="clotheCreate.file_url[]"
        accept=".jpg, .jpeg, .png"
        id="file-input"
        multiple
        class="block p-2 text-sm border rounded-lg cursor-pointer text-gray-400 focus:outline-none bg-gray-700 border-gray-600 placeholder-gray-400"
    >

    @if ($file_url)
        @foreach ($file_url as $index => $image)
            Imagen: <span> {{ $index +1}}</span>
            <img src="{{ $image->temporaryUrl() }}" width="200px" alt="Image">
        @endforeach
    @endif
    <div class="text-green-500" wire:loading wire:target="file_url">
        <svg xmlns="http://www.w3.org/2000/svg" width="5rem" height="5rem" viewBox="0 0 24 24"><circle cx="4" cy="12" r="3" fill="currentColor"><animate id="svgSpinners3DotsScale0" attributeName="r" begin="0;svgSpinners3DotsScale1.end-0.25s" dur="0.75s" values="3;.2;3"/></circle><circle cx="12" cy="12" r="3" fill="currentColor"><animate attributeName="r" begin="svgSpinners3DotsScale0.end-0.6s" dur="0.75s" values="3;.2;3"/></circle><circle cx="20" cy="12" r="3" fill="currentColor"><animate id="svgSpinners3DotsScale1" attributeName="r" begin="svgSpinners3DotsScale0.end-0.45s" dur="0.75s" values="3;.2;3"/></circle></svg>
    </div>

</div>
