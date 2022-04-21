<div class="mb-6">
    <label for="{{ $key }}" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
        {{ $input_title }}
    </label>
    <div class="flex">
        <input type="{{ $type }}" step=".01" id="{{ $key }}" name="{{ $key }}" max="999"
            class="border border-gray-300 text-gray-900 rounded-l-lg focus:ring-blue-200 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="{{ isset($placeholder) ? $placeholder : '' }}" oninvalid="this.setCustomValidity('Angka maksimum 999')"
            onkeypress="this.setCustomValidity('')">
        <span
            class="inline-flex items-center px-3 text-gray-900 bg-gray-200 rounded-r-lg border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
            {!! $satuan !!}
        </span>
    </div>
</div>
