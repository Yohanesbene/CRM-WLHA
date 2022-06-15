@props(['selected' => false, 'label' => 'No Label', 'data' => [], 'name' => ''])
<p class="text-lg">{{ ucwords($label) }}</p>
<ul class="mb-5 flex flex-wrap gap-5">
  @foreach ($data as $item)
    <li class="relative">
      <input class="peer sr-only" type="radio" value="{{ $item['value'] }}" name="{{ $name }}" id="{{ $item['id'] }}" {{ $selected == $item['value'] ? 'checked' : '' }}>
      <label class="flex cursor-pointer rounded-lg border border-gray-300 bg-white p-5 text-lg hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:bg-green-600 peer-checked:font-bold peer-checked:text-white peer-checked:ring-2" for="{{ $item['id'] }}">{{ ucwords($item['display']) }}</label>
    </li>
  @endforeach
</ul>
