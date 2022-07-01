<x-app-layout>
  @php
    $modal_name = 'modalKonfirmasiDelete';
    $modal_header = 'Konfirmasi Hapus Transaksi Obat';
  @endphp
  <div class="flex h-screen w-full"
    x-cloak x-data="{ {{ $modal_name }}: false, keterangan: null, stok: null, waktu: null, id_transaksi: null, id_obat: null }"
    :class="{ 'overflow-y-hidden': {{ $modal_name }} }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: Modal Delete -->
      <x-modal :modalName=$modal_name :modalHeader=$modal_header>
        <span class="text-lg">
          Anda yakin ingin menghapus
          <div class="my-5 grid grid-cols-2">
            <p class="font-bold">Keterangan </p>
            <p x-html="keterangan"></p>
            <p class="font-bold">Transaksi </p>
            <p x-html="stok"></p>
            <p class="font-bold">Waktu </p>
            <p x-html="waktu"></p>
          </div>
          <p>
            Proses ini tidak dapat diulangi kembali!
          </p>
        </span>
        <form class="flex justify-end" action="{{ route('farmasi.proses_hapus_transaksi') }}" method="post">
          @csrf
          <input type="hidden" name="id_transaksi" x-bind:value="id_transaksi">
          <input type="hidden" name="id_obat" x-bind:value="id_obat">
          <button class="mr-2 flex items-center rounded-md bg-red-400 px-5 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-red-600" type="submit">Ya</button>
          <a class="mr-2 flex items-center rounded-md bg-indigo-400 px-5 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600" href="#" @click="{{ $modal_name }} = false">Batalkan</a>
        </form>
      </x-modal>
      {{-- END: Modal Delete --}}
      <!-- START: List Obat -->
      <div class="block rounded-md bg-white p-8">
        <h2 class="text-black-400 mb-3 text-3xl font-semibold leading-tight">Inventaris Obat - {{ $obat->namaobat }}</h2>
        <p class="text-xl">Total Stock : {{ $stok }}</p>
        <span class="italic">{{ $obat->kode_slug }}</span>
        <div class="m-3 flex gap-0">
          <input
            type="date" name="startDate" id="startDate"
            class="z-10 rounded-l-lg border border-r-0 border-indigo-200 p-3 text-lg focus:outline-none">
          <span class="z-0 inline-block border border-l-0 border-r-0 border-indigo-200 bg-slate-100 p-3 text-lg">Sampai</span>
          <input type="date" name="endDate" id="endDate"
            class="z-10 border border-l-0 border-indigo-200 p-3 text-lg focus:outline-none">
          <button id="clearDate" class="mr-2 flex items-center rounded-r-md bg-red-400 px-4 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-red-600">Hapus Filter Tanggal</button>

        </div>
        <div class="mt-2 flex">
          <div class="mt-2 mr-auto flex">
            <a href={{ route('farmasi.tambah_transaksi', ['id_obat' => $obat->id]) }} class="mr-2 flex items-center rounded-md bg-indigo-400 px-2 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">Tambah Transaksi Baru</a>
          </div>
          <a href={{ route('farmasi.index') }} class="ml-auto flex items-center rounded-md bg-indigo-400 px-2 py-2 align-middle font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">
            Kembali
          </a>
        </div>

        @if (Session::has('message'))
          <div class="my-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert">
            {{ Session::get('message') }}
          </div>
        @endif

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
      var startDate = "";
      var endDate = '';
      const dt_table = $('#table-data').DataTable({
        "processing": true,
        "serverSide": true,
        order: [
          [3, 'desc']
        ],
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        responsive: true,
        buttons: [{
          extend: 'print',
          exportOptions: {
            columns: [0, 1, 2, 3, 4]
          }
        }],
        "ajax": {
          "url": "{{ route('farmasi.transaksi_data', ['data']) }}",
          "dataType": "json",
          "type": "POST",
          "data": function(dtParams) {
            dtParams._token = "{{ csrf_token() }}";
            dtParams.id = "{{ $obat->id }}";
            dtParams.startDate = $('#startDate').val();
            dtParams.endDate = $('#endDate').val();
            return dtParams
          }
        },

        columnDefs: [{
          orderable: false,
          targets: [0, 4]
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

      function draw_table(startDate = "", endDate = "") {
        dt_table.ajax = {
          "url": "{{ route('farmasi.transaksi_data', ['data']) }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}",
            id: "{{ $obat->id }}",
            startDate: startDate,
            endDate: endDate
          },
        }

        dt_table.draw();
      }

      draw_table();

      $(document).on('change', '#startDate', () => {
        startDate = $('#startDate').val();
        endDate = $('#endDate').val();
        draw_table(startDate, endDate);
      })

      $(document).on('change', '#endDate', () => {
        startDate = $('#startDate').val();
        endDate = $('#endDate').val();
        draw_table(startDate, endDate);
      })

      $(document).on('click', '#clearDate', () => {
        startDate = $('#startDate').val("");
        endDate = $('#endDate').val("");
        draw_table(startDate, endDate);
      })
    });
  </script>
</x-app-layout>
