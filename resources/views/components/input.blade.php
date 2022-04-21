@props(['disabled' => false, 'invalid' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    @if ($invalid == 'true') {!! $attributes->merge(['class' => 'w-full px-3 py-2 placeholder-red-400 border border-red-300 text-red-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-red-700 dark:text-white dark:placeholder-red-500 dark:border-red-600 dark:focus:ring-red-900 dark:focus:border-red-500 mb-4']) !!}
    @elseif($invalid == 'success')
        {!! $attributes->merge(['class' => 'w-full px-3 py-2 placeholder-green-400 border border-green-300 text-green-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-green-700 dark:text-white dark:placeholder-green-500 dark:border-green-600 dark:focus:ring-green-900 dark:focus:border-green-500 mb-4']) !!}
    @else
        {!! $attributes->merge(['class' => 'w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500 mb-4']) !!} @endif />
