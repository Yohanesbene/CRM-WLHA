<div class="inline-block min-w-full overflow-hidden rounded-lg border-b border-gray-200 align-middle shadow-md">
  <table id="table-data" class="min-w-full">
    <thead class="bg-gray-50">
      <tr class="text-base uppercase leading-normal text-black">
        <th class="py-3 px-6 text-left font-semibold">ID</th>
        <th class="py-3 px-6 text-left font-semibold">Nama Penghuni</th>
        <th class="py-3 px-6 text-left font-semibold">Action</th>
      </tr>
    </thead>
    <tbody class="bg-white text-base font-light text-gray-700">
      @foreach ($penghuni as $row)
        <tr class="border-b border-gray-200 hover:bg-gray-100">
          <td class="whitespace-nowrap py-3 px-6 text-left">
            <div class="flex items-center">
              <span class="font-medium">{{ $row->no_induk }}/{{ $row->id }}</span>
            </div>
          </td>
          <td class="whitespace-nowrap py-3 px-6 text-left">
            <div class="flex items-center">
              <span class="font-medium">{{ $row->nama }}</span>
            </div>
          </td>
          <td class="whitespace-nowrap py-3 px-6 text-left">
            <div class="flex items-center">
              <a href="detail_medis/{{ $row->id }}"
                class="rounded-lg bg-purple-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-purple-800 focus:ring-4 focus:ring-purple-300">
                Rekam Medis
              </a>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="my-2 p-1">
  {{ $penghuni->onEachSide(5)->withPath($page_url)->links('pagination::tailwind') }}
</div>
