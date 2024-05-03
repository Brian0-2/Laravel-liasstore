@props(['file_url'])

<picture>
    <source srcset="{{ asset('storage/images/' . $file_url . '.webp') }}" type="image/webp">
    <source srcset="{{ asset('storage/images/' . $file_url . '.png') }}" type="image/png">
    <img loading="lazy" width="200px" height="300px" src="{{ asset('storage/images/' . $file_url . '.png') }}" alt="imagen {{ $file_url }}"
    {{ $attributes->merge(['class' => '']) }}
    >
</picture>
