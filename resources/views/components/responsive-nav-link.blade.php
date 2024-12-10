@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white focus:outline-none
focus:border-indigo-100 transition duration-150 ease-in-out'
: 'inline-flex items-center px-4 py-1 text-sm font-medium leading-5 text-white rounded focus:outline-none focus:ring-2
focus:ring-offset-2 focus:ring-indigo-500 hover:bg-black hover:text-white hover:rounded-md hover:no-underline transition duration-150
ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
