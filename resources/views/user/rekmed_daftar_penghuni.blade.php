<div class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
    <table id="table-data" class="min-w-full">
        <thead class="bg-gray-50">
            <tr class="text-black uppercase text-base leading-normal">
                <th class="text-left py-3 px-6 font-semibold">ID</th>
                <th class="text-left py-3 px-6 font-semibold">Nama Penghuni</th>
                <th class="text-left py-3 px-6 font-semibold">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-base font-light bg-white">
            @foreach ($penghuni as $row)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $row->no_induk }}/{{ $row->id }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="font-medium">{{ $row->nama }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <div class="flex items-center">
                            <a href="detail_medis/{{ $row->id }}"
                                class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
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
