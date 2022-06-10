<div class="mb-6">
  <label for="{{ $key }}" class="mb-2 block font-medium text-gray-900">
    {{ $input_title }}
  </label>
  <select id="{{ $key }}" name="{{ $key }}"
    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
    <option value="" selected>Pilih Salah Satu</option>
    @foreach ($options as $option)
      <option value="{{ $option }}">{{ $option }} {!! $satuan !!}</option>
    @endforeach
  </select>
</div>
