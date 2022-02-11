<x-app-user-layout>
    {{-- @section('contents') --}}
    <div class="flex-auto bg-indigo-50 py-6 px-10">
        {{-- START: data penghuni --}}
        <div class="block p-8 bg-white rounded-md">
            <div class="flex flex-nowrap gap-3">
                <div>
                    <div class="w-48 h-48 bg-gray-200">

                    </div>
                </div>
                <div class="leading-loose">
                    <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
                    <p>Kode Ruang : {{ $penghuni->ruang }}</p>
                </div>
            </div>
            <div class="flex mt-4 text justify-end">
                <a href="{{ route('user.mcu.tambah', ['id' => $penghuni->id]) }}">
                    <button class="p-3 rounded-md bg-indigo-200 hover:bg-indigo-600 hover:text-gray-50">
                        Input Rekam Medis
                    </button>
                </a>
            </div>
        </div>
        {{-- END: data penghuni --}}
        @if (Session::has('message'))
            <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200"
                role="alert">
                <ul>
                    <li>{{ Session::get('message') }} <span class="float-right"><a
                                href="{{ url()->current() }}">x</a></span></li>
                </ul>
            </div>
        @endif
        {{-- START: berat_badan, spo2, nadi, suhu_badan --}}
        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach ($data as $key => $data)
                @if (count($data) > 0)
                    <div class="block p-8 col-span-2 lg:col-auto bg-white rounded-md max-h-96">
                        <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                        <div class="overflow-y-auto max-h-72 mb-8">
                            <ul class="list-none">
                                @foreach ($data as $row)
                                    <li class="border-b py-2">
                                        <div class="font-medium grid flex flex-row lg:grid lg:grid-cols-2">
                                            <div class="grid grid-rows-2">
                                                <div>
                                                    {{ $row->waktu }}
                                                </div>
                                                <div>
                                                    {{ $row->id_pegawai }}
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 gap-2 items-center justify-center text-lg">
                                                <div>{{ $row->hasil }}{!! $satuan[$key] !!}</div>
                                                <div class="flex place-content-end p-2">
                                                    <a href="{{ route('user.mcu.hapus', ['id' => $row->id, 'data' => $key, 'id_penghuni' => $penghuni->id]) }}">
                                                        <button class="p-3 rounded-md bg-red-200 hover:bg-red-600 hover:text-gray-50">
                                                            Hapus
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{-- END: berat_badan, spo2, nadi, suhu_badan --}}
        {{-- START: tekanan_darah --}}
        @foreach ($data_2 as $key => $data)
            @if ($data->count() > 0)
                <div class="block p-8 bg-white col-span-2 mt-4 rounded-md">
                    <div class="grid grid-cols-2 gap-4 justify-between">
                        <div class="block col-span-2 border-b pb-3">
                            <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                        </div>
                        @foreach (['sistole', 'diastole'] as $k)
                            <div class="block col-span-2 2xl:col-auto max-h-96">
                                <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $k)) }}</p>
                                <div class="overflow-y-auto max-h-72 mb-8">
                                    <ul class="list-none">
                                        @foreach (collect($data)->whereNotNull($k)->all()
    as $row)
                                            <li class="border-b py-2">
                                                <div class="font-medium grid flex flex-row lg:grid lg:grid-cols-2">
                                                    <div class="grid grid-rows-2">
                                                        <div>
                                                            {{ $row->waktu }}
                                                        </div>
                                                        <div>
                                                            {{ $row->id_pegawai }}
                                                        </div>
                                                    </div>
                                                    <div class="grid grid-cols-2 gap-2 items-center justify-center text-lg">
                                                        <div>{{ $row->{$k} }}</div>
                                                        <div class="flex place-content-end p-2">
                                                            <a href="{{ route('user.mcu.hapus', ['id' => $row->id, 'data' => $key, 'id_penghuni' => $penghuni->id]) }}">
                                                                <button class="p-3 rounded-md bg-red-200 hover:bg-red-600 hover:text-gray-50">
                                                                    Hapus
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
        {{-- END: makan --}}
        {{-- START: makan --}}
        @foreach ($data_3 as $key => $data)
            @if ($data->count() > 0)
                <div class="block p-8 bg-white col-span-3 mt-4 rounded-md">
                    <div class="grid grid-cols-3 gap-4 justify-between">
                        <div class="block col-span-3 border-b pb-3">
                            <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                        </div>
                        @foreach (['pagi', 'siang', 'sore'] as $k)
                            @if (collect($data)->whereNotNull($k)->count() > 0)
                                <div class="block col-span-3 2xl:col-auto max-h-96">
                                    <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $k)) }}</p>
                                    <div class="overflow-y-auto max-h-72 mb-8">
                                        <ul class="list-none">
                                            @foreach (collect($data)->whereNotNull($k)->all()
    as $row)
                                                <li class="border-b py-2">
                                                    <div class="font-medium grid flex flex-row lg:grid lg:grid-cols-2">
                                                        <div class="grid grid-rows-2">
                                                            <div>
                                                                {{ $row->waktu }}
                                                            </div>
                                                            <div>
                                                                {{ $row->id_pegawai }}
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-2 gap-2 items-center justify-center text-lg">
                                                            <div>{{ $row->{$k} }}</div>
                                                            <div class="flex place-content-end p-2">
                                                                <a href="{{ route('user.mcu.hapus', ['id' => $row->id, 'data' => $key, 'id_penghuni' => $penghuni->id]) }}">
                                                                    <button class="p-3 rounded-md bg-red-200 hover:bg-red-600 hover:text-gray-50">
                                                                        Hapus
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
        {{-- END: makan --}}
        {{-- @endsection --}}
</x-app-user-layout>
