<p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }} ( {!! $satuan[$key] !!} )</p>
<div class="mb-4 max-w-full overflow-x-auto">
    @php
        $data_key = array_keys((array) $data[0]);
    @endphp
    <table class="table-auto min-w-full mt-4 ">
        <thead thead class="bg-gray-50">
            <tr class="text-black uppercase text-base leading-normal sticky">
                @foreach ($data_key as $k)
                    @if (!in_array($k, ['id', 'deleted', 'id_penghuni']))
                        <th class="text-left py-3 px-6 font-semibold">{{ str_replace('_', ' ', $k) }}</th>
                    @endif
                @endforeach
                <th class="text-left py-3 px-6 font-semibold">action</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 text-base font-light bg-white">
            @foreach ($data as $row)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    @foreach ($data_key as $k)
                        @if (!in_array($k, ['id', 'deleted', 'id_penghuni']))
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $row->{$k} }}</td>
                        @endif
                    @endforeach
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <a href="{{ route('user.mcu.hapus', ['id' => $row->id, 'data' => $key, 'id_penghuni' => $penghuni->id]) }}">
                            <button class="p-3 rounded-md bg-red-200 hover:bg-red-600 hover:text-gray-50">
                                Hapus
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $data->onEachSide(2)->withPath($page_url)->links('pagination::tailwind_detail_medis') }}
