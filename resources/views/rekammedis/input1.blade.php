<div class="mb-6">
  <label for="{{ $key }}" class="mb-2 block font-medium text-gray-900">
    {{ $input_title }}
  </label>
  <div class="flex">
    <input type="{{ $type }}" step=".01" id="{{ $key }}" name="{{ $key }}" max="999"
      class="block w-full rounded-l-lg border border-gray-300 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-200"
      placeholder="{{ isset($placeholder) ? $placeholder : '' }}" oninvalid="this.setCustomValidity('Angka maksimum 999')"
      onkeypress="this.setCustomValidity('')">
    <span
      class="inline-flex items-center rounded-r-lg border border-r-0 border-gray-300 bg-gray-200 px-3 text-gray-900">
      {!! $satuan !!}
    </span>
  </div>
</div>
