@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'bg-green-100 border-l-4 border-green-500 text-green-700 p-2 rounded-lg']) }}>
        {{ $status }}
    </div>
@endif
