@props(['value'])

<label {{ $attributes->merge(['class' => 'block mb-2 text-lg text-gray-800 dark:text-gray-400']) }}>
    {{ $value ?? $slot }}
</label>