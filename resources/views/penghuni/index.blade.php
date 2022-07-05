<x-app-layout>

  {{-- ADMIN DASHBOARD <br>
    YANG LOGIN SIAPA ? <br>
    -------------------------------------------------------------------------------------------------<br>
    {{ Session::get('auth_wlha')->pluck('id')[0] }} <br>
    -------------------------------------------------------------------------------------------------<br>

    <button type="button"><a href="{{route('penghuni.tambah')}}">Tambah Penghuni</a></button>
    <button type="button"><a href="{{route('penghuni.edit')}}">Ubah Penghuni</a></button>
    <!-- <button type="button"><a href="{{route('auth.logout')}}">Logout</a></button> -->
    <div>
        @if (Session::has('message_success'))
        @for ($i = 0; $i < count(Session::get('message_success')); $i++) {{ Session::get('message_success')[$i] }} @endfor @endif </div> --}}

  <div class="flex h-screen w-full" x-data="{ modalAddPenghuni: false, modalDetailUser: false, modalEditPenghuni: false, modalGantiPassword: false }" :class="{ 'overflow-y-hidden': modalAddPenghuni || modalDetailUser || modalEditPenghuni || modalGantiPassword }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div>
        @if (Session::has('message_success'))
          @for ($i = 0; $i < count(Session::get('message_success')); $i++)
            <div class="mb-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert">
              {{ Session::get('message_success')[$i] }}
            </div>
          @endfor
        @endif
      </div>
      {{ Session::get('error_tambah') }}

      <!-- START: List Penghuni -->
      <div class="block rounded-md bg-white p-8">
        <!-- START: Heading -->
        <h2 class="text-black-400 text-3xl font-semibold leading-tight">Daftar Penghuni</h2>
        <div class="flex">
          <a href="{{ route('penghuni.tambah') }}" class="mr-auto">
            <button class="mt-5 flex items-center rounded-md bg-indigo-400 px-4 py-2 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600">
              <svg class="mr-2 justify-center" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="inline-block h-6 w-6">
                <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" fill="currentColor" />
              </svg>
              Tambah Penghuni
            </button>
          </a>
        </div>

        <!-- END: Heading -->
        <!-- START: Data Table -->
        <div class="mt-8 flex flex-col">
          <div class="overflow-x-auto">
            <div class="inline-block min-w-full overflow-hidden rounded-lg border-b border-gray-200 align-middle shadow-md">
              <table id="table-data" class="display cell-border min-w-full" width="100%">
                <thead class="bg-gray-50">
                  <tr class="text-base uppercase leading-normal text-black">
                    <th class="py-3 px-6 text-left font-semibold">ID</th>
                    <th class="py-3 px-6 text-left font-semibold">Nama</th>
                    <th class="py-3 px-6 text-left font-semibold">Tanggal Lahir</th>
                    <th class="py-3 px-6 text-left font-semibold">Ruang</th>
                    <th class="py-3 px-6 text-left font-semibold">Status</th>
                    <th class="py-3 px-6 text-left font-semibold">Action</th>
                  </tr>
                </thead>
                {{-- <tbody class="text-gray-700 text-base font-light bg-white">
                                    <?php $i = 0; ?>
                                    @foreach ($user as $u)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-medium">{{ $u->no_induk }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ $u->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ $u->tgl_lahir }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ $u->ruang }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($u->meninggal == 0 || $u->keluar == 0)
                                                        <span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm">Active</span>
                                                    @else
                                                        <span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm">Inactive</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="flex py-3 px-6">
                                                <div class="flex items-center space-x-4">
                                                    <button class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" @click="modalDetailUser = true" id="details" data-id="{{ $u->id }}">Details</button>
                                                    <a href="{{ route('penghuni.ubah', [$u->id]) }}" class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" id="edit" data-id="{{ $u->id }}">Edit</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i += 1; ?>
                                    @endforeach
                                </tbody> --}}
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- END: List Penghuni -->
    </div>

    @if (count($errors) > 0)
      <div x-init="{ modalAddPenghuni: true }"></div>
    @endif
    <!-- START: Modal Detail Penghuni -->
    <div class="fixed inset-0 z-20 h-full w-full overflow-y-auto bg-black bg-opacity-50 duration-300" x-show="modalDetailUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <div class="relative mx-2 my-10 opacity-100 sm:mx-auto sm:w-3/4 md:w-1/2 lg:w-2/4" @click.away="modalDetailUser = false" x-show="modalDetailUser" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">>
        <div class="relative z-20 rounded-md bg-white p-8 text-gray-900 shadow-lg">
          <header class="mb-12 flex items-center justify-between">
            <h2 class="text-xl font-semibold uppercase">Detail User</h2>
            <button class="p-2 focus:outline-none" @click="modalDetailUser = false">
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
              </svg>
            </button>
          </header>
          <div class="mb-8 flex items-center">
            {{-- <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" src="https://randomuser.me/api/portraits/men/24.jpg" alt="User Picture"> --}}
            <img id="detailFoto" class="mx-auto h-48 w-48 rounded-full" alt="User Picture">

          </div>
          <div class="grid text-base md:grid-cols-2">
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Nama Lengkap </div>
              <div class="py-2 pr-4" id="detailNama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">No Rekam Medis</div>
              <div class="py-2 pr-4" id="detailNRM"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Jenis Kelamin</div>
              <div class="py-2 pr-4" id="detailJenisKelamin"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Alamat</div>
              <div class="py-2 pr-4" id="detailAlamat"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Nomor Telepon</div>
              <div class="py-2 pr-4" id="detailNoTelp"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Tgl Lahir</div>
              <div class="py-2 pr-4" id="detailTglLahir"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Agama</div>
              <div class="py-2 pr-4" id="detailAgama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Asal Daerah</div>
              <div class="py-2 pr-4" id="detailAsalDaerah"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Ruang</div>
              <div class="py-2 pr-4" id="detailRuang"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Tgl Masuk</div>
              <div class="py-2 pr-4" id="detailTglMasuk"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold">Tgl Keluar</div>
              <div class="py-2 pr-4" id="detailTglKeluar"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="py-2 pr-4 font-semibold" id="detailStatusPenghuni">Status Penghuni</div>
              <div class="py-2 pr-4">
                <span class="rounded-full bg-green-200 py-1 px-3 text-sm font-semibold text-green-700" id="detailActive">Active</span>
                <span class="rounded-full bg-red-200 py-1 px-3 text-sm font-semibold text-red-700" id="detailInActive">Inactive</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: Modal Detail Penghuni -->
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
        columnDefs: [{
          orderable: false,
          targets: 5
        }],
        "ajax": {
          "url": "{{ route('penghuni.data') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}"
          }
        },
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'nama'
          },
          {
            'data': 'tgl_lahir'
          },
          {
            'data': 'ruang'
          },
          {
            'data': 'status'
          },
          {
            'data': 'action'
          }
        ],
      });

      $(document).on('click', '#details', function() {
        id = $(this).data('id');
        $.ajax({
          url: "{{ route('penghuni.detail') }}",
          method: "POST",
          data: {
            '_token': '{{ csrf_token() }}',
            id: id
          },
          success: function(data) {
            document.getElementById("detailNama").innerHTML = data["nama"];
            document.getElementById("detailJenisKelamin").innerHTML = data["gender"];
            document.getElementById("detailAlamat").innerHTML = data["alamat"];
            document.getElementById("detailNoTelp").innerHTML = data["notelp"];
            document.getElementById("detailNRM").innerHTML = data["no_induk"];
            document.getElementById("detailTglLahir").innerHTML = data["tgl_lahir"];
            document.getElementById("detailAgama").innerHTML = data["agama"];
            document.getElementById("detailTglMasuk").innerHTML = data["tgl_masuk"];
            document.getElementById("detailTglKeluar").innerHTML = data["tgl_keluar"];
            document.getElementById("detailRuang").innerHTML = data["ruang"];
            document.getElementById("detailAsalDaerah").innerHTML = data["asal_daerah"];
            if (data["foto"] != null) {
              $("#detailFoto").attr("src", "/photos/" + data["foto"]);
            } else {
              $("#detailFoto").attr("src", "https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png");
            }
            console.log(data["foto"] != null);
            if (data["status"] == 0) {
              $("#detailActive").hide();
              $("#detailInActive").show();
            } else {
              $("#detailActive").show();
              $("#detailInActive").hide();
            }
          },

          error: function(data) {
            console.log(data);
          }
        });
      });

      $(document).on('click', '#edit', function() {
        id = $(this).data('id');
        $.ajax({
          url: "{{ route('penghuni.edit.get') }}",
          method: "POST",
          data: {
            '_token': '{{ csrf_token() }}',
            id: id
          },
          success: function(data) {
            // console.log(data);
            $user = data;
            $('#editnama').val($user["nama"]);
            if ($user["gender"] == "pria") {
              $('input#editpria').attr('checked', 'checked');
            } else {
              $('input#editwanita').attr('checked', 'checked');
            }
            $('#edittgl_lahir').val($user["tgl_lahir"]);
            if ($user["agama"] == "katolik") {
              $('input#editkatolik').attr('checked', 'checked');
            } else if ($user["agama"] == "kristen") {
              $('input#editkristen').attr('checked', 'checked');
            } else if ($user["agama"] == "islam") {
              $('input#editislam').attr('checked', 'checked');
            } else if ($user["agama"] == "hindu") {
              $('input#edithindu').attr('checked', 'checked');
            } else if ($user["agama"] == "budha") {
              $('input#editbudha').attr('checked', 'checked');
            } else if ($user["agama"] == "kepercayaan") {
              $('input#editkepercayaan').attr('checked', 'checked');
            }
            $('#editalamat').val($user["alamat"]);
            $('#editnotelp').val($user["notelp"]);
            $('#editruang').val($user["ruang"]);
            if ($user['foto'] != null) {
              $("#editPreviewImg").attr("src", "/storage/photo/" + $user["foto"]);
            } else {
              $("#editPreviewImg").attr("src",
                "https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
              );
            }
          },

          error: function(data) {
            alert("Error!!! Harap coba lagi");
          }
        });
      });


      $('#formEdit').submit(function() {
        event.preventDefault();
        console.log("Form Edit Submit");
        var formData = new FormData(this);

        $.ajax({
          method: "POST",
          url: "{{ route('penghuni.prosesubah') }}",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          success: function(data) {

            console.log(data);
            window.location.replace("{{ route('pegawai.index') }}");
          },

          error: function(data) {
            alert("Gagal ada error");
            alert(data.error);
          }
        });

      });

    });


    function previewFile(input, change) {
      if (change == "edit") {
        // var file = $("input[type=file]").get(0).files[0];
        var file = $("#editFoto").get(0).files[0];
      } else if (change == "tambah") {
        var file = $("#tambahFoto").get(0).files[0];
      }
      if (file) {
        var reader = new FileReader();
        reader.onload = function() {
          if (change == "edit") {
            $('#editPreviewImg').attr("src", reader.result);
          } else if (change == "tambah") {
            $('#tambahPreviewImg').attr("src", reader.result);
          }
        }
        reader.readAsDataURL(file);
      }
    }
  </script>

</x-app-layout>
