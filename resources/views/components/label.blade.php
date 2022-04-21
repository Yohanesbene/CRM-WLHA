@props(['value', 'invalid' => false])

<label {{ $invalid != 'true'? $attributes->merge(['class' => 'block mb-2 text-lg text-gray-800 dark:text-gray-400']): $attributes->merge(['class' => 'block mb-2 text-lg text-red-500 dark:text-red-400']) }}>
    {{ $value ?? $slot }}
</label>
