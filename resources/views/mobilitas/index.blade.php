<x-app-layout>
  <div class="flex h-screen w-full"
    x-data="{ modalDetailMobilitas: false }"
    :class="{ 'overflow-y-hidden': modalDetailMobilitas }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Mobilitas -->
      <div class="block p-8 bg-white rounded-md">
        <h2 class="text-3xl font-semibold text-black-400 leading-tight mb-3">Daftar Mobilitas</h2>
        <div class="flex">
          <a href="{{ route('mobilitas.tambah') }}">
            <button
              class=" flex bg-indigo-400 px-2 py-2 align-middle rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200">
              <svg class="mr-2 justify-center" width="24" height="30" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block">
                <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" fill="currentColor" />
              </svg>
              Tambah Mobilitas
            </button>
          </a>
        </div>
        <!-- START: Data Table -->
        <div class="flex flex-col mt-8">
          <div>
            @if (Session::has('message_success'))
              @for ($i = 0; $i < count(Session::get('message_success')); $i++)
                <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-red-200"
                  role="alert">
                  {{ Session::get('message_success')[$i] }}
                </div>
              @endfor
            @endif
          </div>
          <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
              <table id="table-data" class="min-w-full display cell-border">
                <thead class="bg-gray-50">
                  <tr class="text-black uppercase text-base leading-normal">
                    <th class="text-left py-3 px-6 font-semibold">ID</th>
                    <th class="text-left py-3 px-6 font-semibold">No Induk / Nama</th>
                    <th class="text-left py-3 px-6 font-semibold">Tujuan</th>
                    <th class="text-left py-3 px-6 font-semibold">Waktu Keberangkatan</th>
                    <th class="text-left py-3 px-6 font-semibold">Waktu Kepulangan</th>
                    <th class="text-left py-3 px-6 font-semibold">Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
      x-show="modalDetailMobilitas" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
      x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <div class="relative sm:w-3/4 md:w-1/2 lg:w-2/4 mx-2 sm:mx-auto my-10 opacity-100"
        @click.away="modalDetailMobilitas = false" x-show="modalDetailMobilitas"
        x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
        x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
        x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">>
        <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
          <header class="flex items-center justify-between mb-12">
            <h2 class="font-semibold uppercase text-xl">Detail Mobilitas</h2>
            <button class="focus:outline-none p-2" @click="modalDetailMobilitas = false">
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 18 18">
                <path
                  d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
              </svg>
            </button>
          </header>
          <div class="flex items-center mb-8">
            {{-- <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" src="https://randomuser.me/api/portraits/men/24.jpg" alt="User Picture"> --}}
            <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" alt="User Picture">

          </div>
          <div class="grid text-base">
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Nama Lengkap </div>
              <div class="pr-4 py-2" id="detailNama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">No. Telp. Darurat </div>
              <div class="pr-4 py-2" id="detailKontak"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Tujuan Keluar </div>
              <div class="pr-4 py-2" id="detailTujuan"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Tanggal Keluar</div>
              <div class="pr-4 py-2" id="detailTglKeluar"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Petugas Keluar</div>
              <div class="pr-4 py-2" id="detailPetugasKeluar"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Tanggal Kembali</div>
              <div class="pr-4 py-2" id="detailTglKembali"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Petugas Kembali</div>
              <div class="pr-4 py-2" id="detailPetugasKembali"></div>
            </div>
          </div>
          <div class="grid grid-cols-2">
            <div class="pr-4 py-2 font-semibold" id="detailStatusUser">Status Mobilitas</div>
            <div class="pr-4 py-2">
              <span id="detailStatus" class="font-semibold py-1 px-3 rounded-full text-sm"
                id="detailActive"></span>
            </div>
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
        order: [
          [3, 'asc']
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
          "url": "{{ route('mobilitas.data') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}"
          }
        },
        columnDefs: [{
          orderable: false,
          targets: 5
        }],
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'no_induk_nama'
          },
          {
            'data': 'tujuan'
          },
          {
            'data': 'keluar'
          },
          {
            'data': 'kembali'
          },
          {
            'data': 'action'
          }
        ],
      });

      $(document).on('click', '#details', function() {
        id = $(this).data('id');
        $.ajax({
          url: "{{ route('mobilitas.detail') }}",
          method: "POST",
          data: {
            '_token': '{{ csrf_token() }}',
            id: id
          },
          success: function(data) {
            console.log(data)
            $("#detailNama").html(data['penghuni']["nama"]);
            $("#detailKontak").html(data['penghuni']["notelp_darurat"]);
            $("#detailTujuan").html(data['mobilitas']["tujuan"]);
            $("#detailTglKeluar").html(data['mobilitas']["keluar"]);
            $("#detailPetugasKeluar").html(data['mobilitas']["petugas_keluar"]);
            $("#detailTglKembali").html(data['mobilitas']["kembali"]);
            $("#detailPetugasKembali").html(data['mobilitas']["petugas_kembali"]);
            if (data['penghuni']["foto"] != null) {
              $("#detailFoto").attr("src", "/photos/" + data["penghuni"]["foto"]);
            } else {
              $("#detailFoto").attr("src", 'https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png');
            }
            if (data['mobilitas']["kembali"] != null) {
              $('#detailStatus').addClass("bg-green-200 text-green-700");
              $('#detailStatus').html('Sudah Kembali');
            } else {
              $('#detailStatus').addClass("bg-red-200 text-red-700")
              $('#detailStatus').html('Belum Kembali');
            }
          },

          error: function(data) {
            console.log(data);
          }
        });
      });
    });
  </script>
</x-app-layout>
