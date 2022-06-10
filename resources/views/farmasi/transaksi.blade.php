<x-app-layout>
  <div class="flex h-screen w-full"
    x-data="{ modalDetailMobilitas: false }"
    :class="{ 'overflow-y-hidden': modalDetailMobilitas }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Obat -->
      <div class="block rounded-md bg-white p-8">
        <h2 class="text-black-400 mb-3 text-3xl font-semibold leading-tight">Inventaris Obat - {{ $obat->namaobat }}</h2>
        <p class="text-xl">Total Stock : {{ $stok }}</p>
        <span class="italic">{{ $obat->kode_slug }}</span>
        <div class="mt-2 flex">
          <div class="mt-2 mr-auto flex">
            <a href={{ route('farmasi.tambah_transaksi', ['id_obat' => $obat->id]) }} class="mr-2 flex items-center rounded-md bg-indigo-400 px-2 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">Tambah Transaksi Baru</a>
          </div>
          <a href={{ route('farmasi.index') }} class="ml-auto flex items-center rounded-md bg-indigo-400 px-2 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">
            Kembali
          </a>
        </div>
        <!-- START: Data Table -->
        <div class="mt-8 flex flex-col">
          <div>
            @if (Session::has('message_success'))
              @for ($i = 0; $i < count(Session::get('message_success')); $i++)
                <div class="mb-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900"
                  role="alert">
                  {{ Session::get('message_success')[$i] }}
                </div>
              @endfor
            @endif
          </div>
          <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow-md">
              <table id="table-data" class="display cell-border min-w-full">
                <thead class="bg-gray-50">
                  <tr class="text-base uppercase leading-normal text-black">
                    <th class="py-3 px-6 text-left font-semibold">#</th>
                    <th class="py-3 px-6 text-left font-semibold">Keterangan</th>
                    <th class="py-3 px-6 text-left font-semibold">Stock</th>
                    <th class="py-3 px-6 text-left font-semibold">Waktu</th>
                    <th class="py-3 px-6 text-left font-semibold">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table-data').DataTable({
        "processing": true,
        "serverSide": true,
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        responsive: true,
        buttons: [{
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }

        }],
        "ajax": {
          "url": "{{ route('farmasi.transaksi_data') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}",
            id: "{{ $obat->id }}",
          },
        },
        columnDefs: [{
          orderable: false,
          targets: 0
        }],
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'keterangan'
          },
          {
            'data': 'stock'
          },
          {
            'data': 'waktu'
          },
          {
            'data': 'action'
          }
        ],
      });
    });
  </script>
</x-app-layout>
