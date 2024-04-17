@php
    $classes = 'text-xs text-gray-600 rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 -800 font-bold';
@endphp
{{-- $attributes es una variable dentro de los componentes
    merge() es un metodo para unir los atributos que le pasemos pero en la vista
    ej.
     <x-link :href="route('register')">
                Crear Cuenta.
     </x-link>
      <x-link $classes="route('register')">
                Crear Cuenta.
            </x-link>
--}}
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{-- $slot es una variable interna dentro de los componentes que coloca los compentarios dentro de una etiqueta de componente --}}
    {{ $slot }}
</a>
