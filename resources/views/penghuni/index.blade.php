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
            <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-red-200" role="alert">
              {{ Session::get('message_success')[$i] }}
            </div>
          @endfor
        @endif
      </div>
      {{ Session::get('error_tambah') }}

      <!-- START: List Penghuni -->
      <div class="block p-8 bg-white rounded-md">
        <!-- START: Heading -->
        <h2 class="text-3xl font-semibold text-black-400 leading-tight">Daftar Penghuni</h2>
        <div class="flex">
          <a href="{{ route('penghuni.tambah') }}" class="mr-auto">
            <button class="mt-5 flex bg-indigo-400 px-4 py-2 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200">
              <svg class="mr-2 justify-center" width="24" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block">
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
        <div class="flex flex-col mt-8">
          <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
              <table id="table-data" class="min-w-full display cell-border">
                <thead class="bg-gray-50">
                  <tr class="text-black uppercase text-base leading-normal">
                    <th class="text-left py-3 px-6 font-semibold">ID</th>
                    <th class="text-left py-3 px-6 font-semibold">Nama</th>
                    <th class="text-left py-3 px-6 font-semibold">Tanggal Lahir</th>
                    <th class="text-left py-3 px-6 font-semibold">Ruang</th>
                    <th class="text-left py-3 px-6 font-semibold">Status</th>
                    <th class="text-left py-3 px-6 font-semibold">Action</th>
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
    <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" x-show="modalDetailUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
      <div class="relative sm:w-3/4 md:w-1/2 lg:w-2/4 mx-2 sm:mx-auto my-10 opacity-100" @click.away="modalDetailUser = false" x-show="modalDetailUser" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">>
        <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
          <header class="flex items-center justify-between mb-12">
            <h2 class="font-semibold uppercase text-xl">Detail User</h2>
            <button class="focus:outline-none p-2" @click="modalDetailUser = false">
              <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                </path>
              </svg>
            </button>
          </header>
          <div class="flex items-center mb-8">
            {{-- <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" src="https://randomuser.me/api/portraits/men/24.jpg" alt="User Picture"> --}}
            <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" alt="User Picture">

          </div>
          <div class="grid md:grid-cols-2 text-base">
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Nama Lengkap </div>
              <div class="pr-4 py-2" id="detailNama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">No Rekam Medis</div>
              <div class="pr-4 py-2" id="detailNRM"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Jenis Kelamin</div>
              <div class="pr-4 py-2" id="detailJenisKelamin"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Alamat</div>
              <div class="pr-4 py-2" id="detailAlamat"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Nomor Telepon</div>
              <div class="pr-4 py-2" id="detailNoTelp"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Tgl Lahir</div>
              <div class="pr-4 py-2" id="detailTglLahir"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Agama</div>
              <div class="pr-4 py-2" id="detailAgama"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Asal Daerah</div>
              <div class="pr-4 py-2" id="detailAsalDaerah"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Ruang</div>
              <div class="pr-4 py-2" id="detailRuang"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Tgl Masuk</div>
              <div class="pr-4 py-2" id="detailTglMasuk"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold">Tgl Keluar</div>
              <div class="pr-4 py-2" id="detailTglKeluar"></div>
            </div>
            <div class="grid grid-cols-2">
              <div class="pr-4 py-2 font-semibold" id="detailStatusPenghuni">Status Penghuni</div>
              <div class="pr-4 py-2">
                <span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm" id="detailActive">Active</span>
                <span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm" id="detailInActive">Inactive</span>
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
