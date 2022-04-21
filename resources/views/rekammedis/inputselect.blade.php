<div class="mb-6">
    <label for="{{ $key }}" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
        {{ $input_title }}
    </label>
    <select id="{{ $key }}" name="{{ $key }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option value="" selected>Pilih Salah Satu</option>
        @foreach ($options as $option)
            <option value="{{ $option }}">{{ $option }} {!! $satuan !!}</option>
        @endforeach
    </select>
</div>
