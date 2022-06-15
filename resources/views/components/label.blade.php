@props(['value', 'invalid' => false])

<label {{ $invalid != 'true' ? $attributes->merge(['class' => 'block mb-2 text-lg text-gray-800']) : $attributes->merge(['class' => 'block mb-2 text-lg text-red-500 ']) }}>
  {{ $value ?? $slot }}
</label>
