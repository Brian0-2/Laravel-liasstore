@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1 lists-none']) }}>
        @foreach ((array) $messages as $message)
            <li class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 rounded-lg">{{ $message }}</li>
        @endforeach
    </ul>
@endif
