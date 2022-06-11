<div class="fixed inset-0 z-20 h-full w-full overflow-y-auto bg-black bg-opacity-50 duration-300"
  x-show="{{ $modalName }}" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
  x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
  x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
  <div class="relative mx-2 my-10 opacity-100 sm:mx-auto sm:w-3/4 md:w-1/2 lg:w-2/4"
    @click.away="{{ $modalName }} = false" x-show="{{ $modalName }}"
    x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
    x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
    x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">
    <div class="relative z-20 rounded-md bg-white p-8 text-gray-900 shadow-lg">
      <header class="mb-12 flex items-center justify-between">
        <h2 class="text-xl font-semibold uppercase">{{ $modalHeader }}</h2>
        <button class="p-2 focus:outline-none" @click="{{ $modalName }} = false">
          <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 18 18">
            <path
              d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
            </path>
          </svg>
        </button>
      </header>
      {{ $slot }}
    </div>
  </div>
</div>
