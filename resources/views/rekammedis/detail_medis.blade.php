<x-app-layout>
  @php
    $modal_name = 'modalKonfirmasiDelete';
    $modal_header = 'Konfirmasi Hapus Transaksi Obat';
  @endphp
  {{-- @section('contents') --}}
  <div class="flex-auto flex-col bg-indigo-50 py-6 px-10"
    x-cloak x-data="{ {{ $modal_name }}: false, keterangan: null, table: null, id: null, id_penghuni: null, href: null }"
    :class="{ 'overflow-y-hidden': {{ $modal_name }} }">
    {{-- START: Modal Delete --}}

    <x-modal :modalName=$modal_name :modalHeader=$modal_header>
      <span class="text-lg">
        Anda yakin ingin menghapus
        <p class="pl-2 font-bold" x-html="keterangan"></p>
        <p>
          Proses ini tidak dapat diulangi kembali!
        </p>
      </span>
      <div class="flex">
        <form x-bind:action="href" method="post" class="mt-5 flex">
          @csrf
          <input type="hidden" name="table" x-bind:value="table">
          <input type="hidden" name="id" x-bind:value="id">
          <input type="hidden" name="id_penghuni" x-bind:value="id_penghuni">
          <button x-bind:href="href" class="mr-2 flex items-center rounded-md bg-red-400 px-5 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-red-600" type="submit">Ya</button>
          <a class="mr-2 flex items-center rounded-md bg-indigo-400 px-5 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600" href="#" @click="{{ $modal_name }} = false">Batalkan</a>
        </form>
      </div>
    </x-modal>
    {{-- END: Modal Delete --}}
    {{-- START: data penghuni --}}
    <div class="block flex-col rounded-md bg-white p-8">
      <div class="flex flex-col gap-3 lg:flex-row">
        <div>
          <div class="flex h-48 w-48 place-content-center bg-gray-200">
            <img src="/photos/{{ $penghuni->foto }}" alt="" srcset="">
          </div>
        </div>
        <div class="leading-loose">
          <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
          <p>Kode Ruang : {{ $penghuni->ruang }}</p>
        </div>
      </div>
      <div class="text mt-4 flex justify-end">
        <a href="{{ url()->previous() }}" class="mr-5 rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50">
          Kembali
        </a>
        <a href="{{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => 'all']) }}" class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50">
          Input Rekam Medis
        </a>
      </div>
    </div>
    {{-- END: data penghuni --}}
    @if (Session::has('message'))
      <div class="mb-4 rounded-md border border-green-200 bg-green-100 py-3 px-5 text-sm text-green-900 transition-opacity"
        role="alert" id="message">
        <ul>
          <li>{!! Session::get('message') !!} <span class="float-right"><a
                id="dismiss-message" href="#">x</a></span></li>
        </ul>
      </div>
    @endif
    {{-- START: pemberian obat, berat_badan, spo2, nadi, suhu_badan --}}
    <div class="mt-4 grid grid-cols-2 gap-4">
      @foreach ($data as $key => $data)
        @if (count($data) > 0)
          @if ($key == 'pemberian_obat')
            <div class="col-span-2 block h-auto rounded-md bg-white p-8 lg:col-auto">
              <p class="mb-5 text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
              <div class="mb-5 max-h-72 overflow-y-auto">
                <ul class="list-none">
                  @foreach ($data as $row)
                    <li class="border-b py-2">
                      <div class="flex grid flex-row font-medium lg:grid lg:grid-cols-2">
                        <div class="grid grid-rows-2">
                          <div>
                            {{ $row->waktu }}
                          </div>
                          <div>
                            {{ $row->id_pegawai }}
                          </div>
                        </div>
                        <div class="grid grid-cols-2 items-center justify-center gap-2 text-lg">
                          <div class="flex flex-col">
                            <div class="block">{{ $row->namaobat }}</div>
                            <div class="block"> dosis : {{ $row->dosis }}</div>
                          </div>
                          <div class="flex place-content-end p-2">
                            <button
                              @click="
                                    modalKonfirmasiDelete = true;
                                    keterangan = '{{ $row->waktu }} : {{ $row->namaobat }} - {{ $row->dosis }} dosis'
                                    href = '{{ route('rekmed.hapus') }}';
                                    table = '{{ $key }}';
                                    id = '{{ $row->id }}';
                                    id_penghuni= '{{ $penghuni->id }}';
                                " class="rounded-md bg-red-200 p-3 hover:bg-red-600 hover:text-gray-50">
                              Hapus
                            </button>
                          </div>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="flex place-content-end p-2">
                <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
                  Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
                </a>
                <a class="ml-2 rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.data_details', ['id' => $penghuni->id, 'data' => $key]) }}>
                  Detail {{ ucwords(str_replace('_', ' ', $key)) }}
                </a>
              </div>
            </div>
          @else
            <div class="col-span-2 block h-auto rounded-md bg-white p-8 lg:col-auto">
              <p class="mb-5 text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
              <div class="mb-5 max-h-72 overflow-y-auto">
                <ul class="list-none">
                  @foreach ($data as $row)
                    <li class="border-b py-2">
                      <div class="flex grid flex-row font-medium lg:grid lg:grid-cols-2">
                        <div class="grid grid-rows-2">
                          <div>
                            {{ $row->waktu }}
                          </div>
                          <div>
                            {{ $row->id_pegawai }}
                          </div>
                        </div>
                        <div class="grid grid-cols-2 items-center justify-center gap-2 text-lg">
                          <div>{{ $row->hasil }}{!! $satuan[$key] !!}</div>
                          <div class="flex place-content-end p-2">
                            <button
                              @click="
                                    modalKonfirmasiDelete = true;
                                    keterangan = '{{ $row->waktu }} : {{ $row->hasil }}{!! $satuan[$key] !!}'
                                    href = '{{ route('rekmed.hapus') }}';
                                    table = '{{ $key }}';
                                    id = '{{ $row->id }}';
                                    id_penghuni= '{{ $penghuni->id }}';
                                " class="rounded-md bg-red-200 p-3 hover:bg-red-600 hover:text-gray-50">
                              Hapus
                            </button>
                          </div>
                        </div>
                      </div>
                    </li>
                  @endforeach
                </ul>
              </div>
              <div class="flex place-content-end p-2">
                <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
                  Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
                </a>
                <a class="ml-2 rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href="{{ route('rekmed.data_details', ['id' => $penghuni->id, 'data' => $key]) }}">
                  Detail {{ ucwords(str_replace('_', ' ', $key)) }}
                </a>
              </div>
            </div>
          @endif
        @else
          <div class="col-span-2 block h-auto rounded-md bg-white p-8 lg:col-auto">
            <p class="mb-5 text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
            <div class="mx-auto mb-5 max-h-72">
              Belum ada data
            </div>
            <div class="mt-auto flex place-content-end p-2">
              <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
                Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
              </a>
            </div>
          </div>
        @endif
      @endforeach
    </div>
    {{-- END: pemberian obat, berat_badan, spo2, nadi, suhu_badan --}}
    {{-- START: tekanan_darah --}}
    @foreach ($data_2 as $key => $data)
      <div class="col-span-2 mt-4 block rounded-md bg-white p-8">
        @if ($data->count() > 0)
          <div class="col-span-2 mb-5 block border-b pb-3">
            <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
          </div>
          <div class="mb-5 grid max-h-72 grid-cols-4 justify-between gap-4 overflow-y-auto font-medium">
            <div></div>
            <div class="text-2xl font-bold">Sistole</div>
            <div class="text-2xl font-bold">Diastole</div>
            <div></div>
            @foreach ($data as $k => $row)
              <div>
                <div>
                  {{ $row->waktu }}
                </div>
                <div>
                  {{ $row->id_pegawai }}
                </div>
              </div>
              <div>{{ $row->sistole }}{{ $satuan[$key] }}</div>
              <div>{{ $row->diastole }}{{ $satuan[$key] }}</div>
              <div class="flex place-content-end p-2">
                <button
                  @click="
                      modalKonfirmasiDelete = true;
                      keterangan = '{{ $row->waktu }}\{{ $row->id_pegawai }} : <br> {{ $row->sistole }}{{ $satuan[$key] }} - {{ $row->diastole }}{{ $satuan[$key] }}'
                      href = '{{ route('rekmed.hapus') }}';
                      table = '{{ $key }}';
                      id = '{{ $row->id }}';
                      id_penghuni= '{{ $penghuni->id }}';
                  " class="rounded-md bg-red-200 p-3 hover:bg-red-600 hover:text-gray-50">
                  Hapus
                </button>
              </div>
            @endforeach
          </div>
          <div class="flex place-content-end p-2">
            <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
              Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
            </a>
            <a class="ml-2 rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href="{{ route('rekmed.data_details', ['id' => $penghuni->id, 'data' => $key]) }}">
              Detail {{ ucwords(str_replace('_', ' ', $key)) }}
            </a>
          </div>
        @else
          <p class="mb-5 text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
          <div class="mx-auto mb-5 max-h-72">
            Belum ada data
          </div>
          <div class="flex place-content-end p-2">
            <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
              Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
            </a>
          </div>
        @endif
      </div>
    @endforeach
    {{-- END: makan --}}
    {{-- START: makan --}}
    @foreach ($data_3 as $key => $data)
      @if ($data->count() > 0)
        <div class="col-span-3 mt-4 block rounded-md bg-white p-8">
          <div class="grid grid-cols-3 justify-between gap-4">
            <div class="col-span-3 block border-b pb-3">
              <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
            </div>
            @foreach (['pagi', 'siang', 'sore'] as $k)
              @if (collect($data)->whereNotNull($k)->count() > 0)
                <div class="col-span-3 block h-auto 2xl:col-auto">
                  <p class="text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $k)) }}</p>
                  <div class="mb-8 max-h-72 overflow-y-auto">
                    <ul class="list-none">
                      @foreach (collect($data)->whereNotNull($k)->all()
    as $row)
                        <li class="border-b py-2">
                          <div class="flex grid flex-row font-medium lg:grid lg:grid-cols-2">
                            <div class="grid grid-rows-2">
                              <div>
                                {{ $row->waktu }}
                              </div>
                              <div>
                                {{ $row->id_pegawai }}
                              </div>
                            </div>
                            <div class="grid grid-cols-2 items-center justify-center gap-2 text-lg">
                              <div>{{ $row->{$k} }}{!! $satuan[$key] !!}</div>
                              <div class="flex place-content-end p-2">
                                <button
                                  @click="
                                    modalKonfirmasiDelete = true;
                                    keterangan = '{{ $row->waktu }} : {{ $row->{$k} }}{!! $satuan[$key] !!}'
                                    href = '{{ route('rekmed.hapus') }}';
                                    table = '{{ $key }}';
                                    id = '{{ $row->id }}';
                                    id_penghuni= '{{ $penghuni->id }}';
                                " class="rounded-md bg-red-200 p-3 hover:bg-red-600 hover:text-gray-50">
                                  Hapus
                                </button>
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
          <div class="flex place-content-end p-2">
            <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
              Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
            </a>
            <a class="ml-2 rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href="{{ route('rekmed.data_details', ['id' => $penghuni->id, 'data' => $key]) }}">
              Detail {{ ucwords(str_replace('_', ' ', $key)) }}
            </a>
          </div>
        </div>
      @else
        <div class="col-span-3 mt-4 block rounded-md bg-white p-8">
          <p class="mb-5 text-2xl font-bold">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
          <div class="mx-auto mb-5 max-h-72">
            Belum ada data
          </div>
          <div class="flex place-content-end p-2">
            <a class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50" href={{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}>
              Tambah {{ ucwords(str_replace('_', ' ', $key)) }}
            </a>
          </div>
        </div>
      @endif
    @endforeach
    {{-- END: makan --}}
  </div>
  <script>
    $("#dismiss-message").click(function() {
      $("#message").addClass('hidden duration-100');
    });
  </script>
  {{-- @endsection --}}
</x-app-layout>
