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

    <div class="flex h-screen w-full" x-data="{ modalAddPenghuni: false, modalDetailUser: false, modalEditPenghuni: false, modalGantiPassword: false }" :class="{'overflow-y-hidden': modalAddPenghuni || modalDetailUser || modalEditPenghuni || modalGantiPassword}">
        <div class="flex-auto bg-indigo-50 py-6 px-10">
            <!-- START: List Penghuni -->
            <div class="block p-8 bg-white rounded-md">
                <!-- START: Heading -->
                <h2 class="text-3xl font-semibold text-black-400 leading-tight">Daftar Penghuni</h2>
                <!-- END: Heading -->
                <!-- START: Data Table -->
                <div class="flex flex-col mt-8">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
                            <table id="table-data" class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr class="text-black uppercase text-base leading-normal">
                                        <th class="text-left py-3 px-6 font-semibold">ID</th>
                                        <th class="text-left py-3 px-6 font-semibold">Nama</th>
                                        <th class="text-left py-3 px-6 font-semibold">Ruang</th>
                                        <th class="text-left py-3 px-6 font-semibold">Status</th>
                                        <th class="text-left py-3 px-6 font-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-base font-light bg-white">
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
                                                    <a href="{{ route('rekmed.detail', ['id' => $u->id]) }}" class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                        </svg> Rekam Medis
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i += 1; ?>
                                    @endforeach
                                </tbody>
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
        <!-- START: Modal Tambah Penghuni -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" x-show="modalAddPenghuni" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100" @click.away="modalAddPenghuni = false" x-show="modalAddPenghuni" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">

                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-center mt-6 mb-12">
                        <h2 class="font-semibold uppercase text-2xl">Tambah Penghuni</h2>
                    </header>
                    @if (count($errors) > 0)
                        <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('penghuni.prosestambah') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- nama Input -->
                        <x-label for="nama" :value="__('Nama Penghuni')" />
                        <x-input id="nama" type="text" name="nama" :value="old('nama')" placeholder="Masukkan Nama Penghuni Baru" autocomplete="off" />
                        @if (Session::has('error_update.nama'))
                            {{ Session::get('error_update.nama') }}
                            <br>
                        @endif

                        <!-- Tgl Lahir Input -->
                        <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                        <x-input id="tgl_lahir" type="date" name="tgl_lahir" :value="old('tgl_lahir')" autocomplete="off" />
                        @if (Session::has('error_tambah.tgl_lahir'))
                            {{ Session::get('error_tambah.tgl_lahir') }}
                            <br>
                        @endif

                        <!-- Jenis kelamin Input -->
                        <x-label for="gender" :value="__('Jenis Kelamin')" />
                        @foreach (['pria', 'wanita'] as $gender)
                            <x-label for="{{ $gender }}" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="{{ $gender }}" name="gender" value="{{ $gender }}" @if (old('gender') == $gender) checked="checked" @endif />
                                <div class="px-2">{{ ucwords($gender) }}</div>
                            </x-label>
                        @endforeach
                        @if (Session::has('error_tambah.gender'))
                            {{ Session::get('error_tambah.gender') }}
                            <br>
                        @endif

                        <!-- Agama Input -->
                        <x-label for="agama" :value="__('Agama')" />
                        <div class="flex flex-wrap">
                            @foreach (['katolik', 'kristen', 'islam', 'hindu', 'budha', 'kepercayaan'] as $agama)
                                <x-label for="{{ $agama }}" class="flex p-2 cursor-pointer">
                                    <input class="my-auto transform scale-125" type="radio" id="{{ $agama }}" name="agama" value="{{ $agama }}" @if (old('agama') == $agama) checked="checked" @endif />
                                    <div class="px-2">{{ ucwords($agama) }}</div>
                                </x-label>
                            @endforeach
                        </div>
                        @if (Session::has('error_tambah.agama'))
                            {{ Session::get('error_tambah.agama') }}
                            <br>
                        @endif

                        <!-- Alamat Input -->
                        <x-label for="alamat" :value="__('Alamat Penghuni')" />
                        <x-input id="alamat" type="text" name="alamat" :value="old('alamat')" placeholder="Masukkan Alamat Penghuni" autocomplete="off" />
                        @if (Session::has('error_update.alamat'))
                            {{ Session::get('error_update.alamat') }}
                            <br>
                        @endif

                        <!-- notelp Input -->
                        <x-label for="notelp" :value="__('Nomor Telepon Penghuni')" />
                        <x-input id="notelp" type="number" name="notelp" :value="old('notelp')" placeholder="Masukkan No Telepon Penghuni" autocomplete="off" />
                        @if (Session::has('error_update.notelp'))
                            {{ Session::get('error_update.notelp') }}
                            <br>
                        @endif

                        <!-- Ruang Input -->
                        <x-label for="ruang" :value="__('Ruang Rawat')" />
                        <x-input id="ruang" type="text" name="ruang" :value="old('ruang')" placeholder="Masukkan Ruang Rawat" autocomplete="off" />
                        @if (Session::has('error_update.ruang'))
                            {{ Session::get('error_update.ruang') }}
                            <br>
                        @endif

                        <!-- Foto Input -->
                        <x-label for="foto" :value="__('Foto')" />
                        <div class="flex space-x-4 items-center">
                            <img id="tambahPreviewImg" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg" alt="profile image">
                            <input id="tambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
                        </div>


                        <!-- Button Input -->

                        <p class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                            <input type="submit" class="w-full mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200" value="Simpan">

                            <button class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" @click="modalAddPenghuni = false">
                                {{-- <a href="{{ route('penghuni') }}"></a> --}}
                                Batal
                            </button>
                        </p>

                    </form>
                </div>
            </div>
        </div>
        <!-- END: Modal Penghuni -->


        <!-- START: Modal Detail Penghuni -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" x-show="modalDetailUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-2/4 mx-2 sm:mx-auto my-10 opacity-100" @click.away="modalDetailUser = false" x-show="modalDetailUser" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">>
                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-between mt-6 mb-12">
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
                        <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="User Picture">

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


        <!-- START: Modal Edit Penghuni -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto" x-show="modalEditPenghuni" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100" @click.away="modalEditPenghuni = false" x-show="modalEditPenghuni" x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0" x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300" x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">

                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-center mt-6 mb-12">
                        <h2 class="font-semibold uppercase text-2xl">Tambah Penghuni</h2>
                    </header>
                    @if (count($errors) > 0)
                        <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('penghuni.prosestambah') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- nama Input -->
                        <x-label for="editnama" :value="__('Nama Penghuni')" />
                        <x-input id="editnama" type="text" name="nama" :value="old('nama')" placeholder="Masukkan Nama Penghuni Baru" autocomplete="off" />
                        @if (Session::has('error_update.nama'))
                            {{ Session::get('error_update.nama') }}
                            <br>
                        @endif

                        <!-- Tgl Lahir Input -->
                        <x-label for="edittgl_lahir" :value="__('Tanggal Lahir')" />
                        <x-input id="edittgl_lahir" type="date" name="tgl_lahir" :value="old('tgl_lahir')" autocomplete="off" />
                        @if (Session::has('error_tambah.tgl_lahir'))
                            {{ Session::get('error_tambah.tgl_lahir') }}
                            <br>
                        @endif

                        <!-- Jenis kelamin Input -->
                        <x-label for="editgender" :value="__('Jenis Kelamin')" />
                        @foreach (['pria', 'wanita'] as $gender)
                            <x-label for="edit{{ $gender }}" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="edit{{ $gender }}" name="gender" value="{{ $gender }}" @if (old('gender') == $gender) checked="checked" @endif />
                                <div class="px-2">{{ ucwords($gender) }}</div>
                            </x-label>
                        @endforeach
                        @if (Session::has('error_tambah.gender'))
                            {{ Session::get('error_tambah.gender') }}
                            <br>
                        @endif

                        <!-- Agama Input -->
                        <x-label for="editagama" :value="__('Agama')" />
                        <div class="flex flex-wrap">
                            @foreach (['katolik', 'kristen', 'islam', 'hindu', 'budha', 'kepercayaan'] as $agama)
                                <x-label for="edit{{ $agama }}" class="flex p-2 cursor-pointer">
                                    <input class="my-auto transform scale-125" type="radio" id="edit{{ $agama }}" name="agama" value="{{ $agama }}" @if (old('agama') == $agama) checked="checked" @endif />
                                    <div class="px-2">{{ ucwords($agama) }}</div>
                                </x-label>
                            @endforeach
                        </div>
                        @if (Session::has('error_tambah.agama'))
                            {{ Session::get('error_tambah.agama') }}
                            <br>
                        @endif

                        <!-- Alamat Input -->
                        <x-label for="editalamat" :value="__('Alamat Penghuni')" />
                        <x-input id="editalamat" type="text" name="alamat" :value="old('alamat')" placeholder="Masukkan Alamat Penghuni" autocomplete="off" />
                        @if (Session::has('error_update.alamat'))
                            {{ Session::get('error_update.alamat') }}
                            <br>
                        @endif

                        <!-- notelp Input -->
                        <x-label for="editnotelp" :value="__('Nomor Telepon Penghuni')" />
                        <x-input id="editnotelp" type="number" name="notelp" :value="old('notelp')" placeholder="Masukkan No Telepon Penghuni" autocomplete="off" />
                        @if (Session::has('error_update.notelp'))
                            {{ Session::get('error_update.notelp') }}
                            <br>
                        @endif

                        <!-- Ruang Input -->
                        <x-label for="editruang" :value="__('Ruang Rawat')" />
                        <x-input id="editruang" type="text" name="ruang" :value="old('ruang')" placeholder="Masukkan Ruang Rawat" autocomplete="off" />
                        @if (Session::has('error_update.ruang'))
                            {{ Session::get('error_update.ruang') }}
                            <br>
                        @endif

                        <!-- Foto Input -->
                        <x-label for="editfoto" :value="__('Foto')" />
                        <div class="flex space-x-4 items-center">
                            <img id="edittambahPreviewImg" src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png" class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg" alt="profile image">
                            <input id="edittambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
                        </div>


                        <!-- Button Input -->

                        <p class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                            <input type="submit" class="w-full mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200" value="Simpan">

                            <button class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" @click="modalAddPenghuni = false">
                                Batal
                            </button>
                        </p>

                    </form>
                </div>
            </div>
        </div>
        <!-- END: Modal Edit User -->
    </div>

    <script>
        $(document).ready(function() {
            $('#table-data').DataTable();

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
                            $("#detailFoto").attr("src", "/storage/photo/" + data["foto"]);
                        }
                        console.log("/storage/photo/" + data["foto"]);
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
