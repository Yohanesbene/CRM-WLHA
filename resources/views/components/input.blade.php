@props(['disabled' => false, 'invalid' => false])

<input
  {{ $disabled ? 'disabled' : '' }}
  @if ($invalid == 'true') {!! $attributes->merge(['class' => 'text-lg w-full px-3 py-2 placeholder-red-400 border border-red-300 text-red-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 mb-4']) !!}
    @elseif($invalid == 'success')
        {!! $attributes->merge(['class' => 'text-lg w-full px-3 py-2 placeholder-green-400 border border-green-300 text-green-500 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 mb-4']) !!}
    @else
        {!! $attributes->merge(['class' => 'text-lg w-full px-3 py-2 mr-2 placeholder-gray-400 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 mb-4']) !!} @endif />
