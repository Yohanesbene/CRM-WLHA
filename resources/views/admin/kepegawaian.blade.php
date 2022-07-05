<x-app-layout>

    {{-- ADMIN DASHBOARD <br>
    YANG LOGIN SIAPA ? <br>
    -------------------------------------------------------------------------------------------------<br>
    {{ Session::get('auth_wlha')->pluck('id')[0] }} <br>
    -------------------------------------------------------------------------------------------------<br>

    <button type="button"><a  href="{{route('pegawai.tambah')}}">Tambah Pegawai</a></button>
    <button type="button"><a  href="{{route('pegawai.ubahpassword')}}">Ubah Password</a></button>
    <button type="button"><a  href="{{route('auth.logout')}}">Logout</a></button>
    <div>
        @if (Session::has('message_success'))
            @for ($i = 0; $i < count(Session::get('message_success')); $i++)
            {{ Session::get('message_success')[$i] }}
            @endfor
        @endif
    </div> --}}

    <div class="flex h-full w-full"
        x-data="{ modalAddUser: false, modalDetailUser: false, modalEditUser: false, modalGantiPassword: false }"
        :class="{'overflow-y-hidden': modalAddUser || modalDetailUser || modalEditUser || modalGantiPassword}">
        <div class="flex-auto bg-indigo-50 py-6 px-10">
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
            <!-- START: List User -->
            <div class="block p-8 bg-white rounded-md">
                <!-- START: Heading -->
                <div class="flex justify-between">
                    <h2 class="text-3xl font-semibold text-black-400 leading-tight">Daftar User</h2>
                    <button
                        class=" flex bg-indigo-400 px-4 py-2 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200"
                        @click="modalAddUser = true">
                        <svg class="mr-2 justify-center" width="24" height="30" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block">
                            <path d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                    C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                    C15.952,9,16,9.447,16,10z" fill="currentColor" />
                        </svg>
                        <a href="#">Tambah User</a>
                    </button>
                </div>
                <!-- END: Heading -->
                <!-- START: Data Table -->
                <div class="flex flex-col mt-8">
                    <div class="overflow-x-auto">
                        <div
                            class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
                            <table id="table-data" class="min-w-full">
                                <thead class="bg-gray-50">
                                    <tr class="text-black uppercase text-base leading-normal">
                                        <th class="text-left py-3 px-6 font-semibold">ID</th>
                                        <th class="text-left py-3 px-6 font-semibold">Nama</th>
                                        <th class="text-left py-3 px-6 font-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-base font-light bg-white">
                                    <?php $i = 0; ?>
                                    @foreach ($user as $u)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-medium">{{ $u->id }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ $u->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="flex py-3 px-6">
                                                <div class="flex items-center space-x-4">
                                                    <button
                                                        class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200"
                                                        @click="modalDetailUser = true" id="details"
                                                        data-id="{{ $u->id }}">Details</button>
                                                    <button
                                                        class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200"
                                                        @click="modalEditUser = true" id="edit"
                                                        data-id="{{ $u->id }}">Edit</button>
                                                    <button
                                                        class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200"
                                                        @click="modalGantiPassword = true" id="ubahPassword"
                                                        data-id="{{ $u->id }}">Ubah Password</button>
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
            <!-- END: List User -->
        </div>


        <!-- START: Modal Tambah User -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
            x-show="modalAddUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100"
                @click.away="modalAddUser = false" x-show="modalAddUser"
                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">

                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-center mt-6 mb-12">
                        <h2 class="font-semibold uppercase text-2xl">Tambah User</h2>
                    </header>
                    @if (count($errors) > 0)
                        <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('pegawai.prosestambah') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="flex justify-between space-x-4">
                            <!-- Username Input -->
                            <div class="w-1/2 pr-4">
                                <x-label for="username" :value="__('Username')" />
                                <x-input id="username" type="text" name="username" :value="old('username')"
                                    placeholder="Masukkan Username" autofocus autocomplete="off" />
                                @if (Session::has('error_update.username'))
                                    {{ Session::get('error_update.username') }}
                                    <br>
                                @endif
                            </div>
                            <div class="w-1/2">
                                <!-- nama Input -->
                                <x-label for="nama" :value="__('Nama Lengkap')" />
                                <x-input id="nama" type="text" name="nama" :value="old('nama')"
                                    placeholder="Masukkan Nama Lengkap" autocomplete="off" />
                                @if (Session::has('error_update.nama'))
                                    {{ Session::get('error_update.nama') }}
                                    <br>
                                @endif
                            </div>
                        </div>

                        <!-- Password Input -->
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" type="password" name="password" :value="old('password')"
                            placeholder="Masukkan Password" autocomplete="off" />
                        @if (Session::has('error_tambah.password'))
                            {{ Session::get('error_tambah.password') }}
                            <br>
                        @endif

                        <!-- Password Confirmation Input -->
                        <x-label for="password_confirmation" :value="__('Re-type Password')" />
                        <x-input id="password_confirmation" type="password" name="password_confirmation"
                            :value="old('password_confirmation')" placeholder="Masukkan Ulang Password"
                            autocomplete="off" />
                        @if (Session::has('error_tambah.password_confirmation'))
                            {{ Session::get('error_tambah.password_confirmation') }}
                            <br>
                        @endif

                        <!-- Role User Input -->
                        <x-label for="id_level" :value="__('Role User')" />
                        <x-option-select id="id_level" name="id_level">
                            <x-slot name="option">
                                @if (!empty($role))
                                    @foreach ($role as $r)
                                        <option value="{{ $r->id }}" @if (old('id_level') == $r->id) selected @endif>
                                            {{ $r->keterangan }}</option>
                                    @endforeach
                                @endif
                            </x-slot>
                        </x-option-select>

                        <!-- NIK Input -->
                        <x-label for="nik" :value="__('NIK (Sesuai KTP)')" />
                        <x-input id="nik" type="text" name="nik" :value="old('nik')" placeholder="Masukkan NIK"
                            autocomplete="off" />
                        @if (Session::has('error_tambah.nik'))
                            {{ Session::get('error_tambah.nik') }}
                            <br>
                        @endif

                        <!-- Tgl Lahir Input -->
                        <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                        <x-input id="tgl_lahir" type="date" name="tgl_lahir" :value="old('tgl_lahir')"
                            autocomplete="off" />
                        @if (Session::has('error_tambah.tgl_lahir'))
                            {{ Session::get('error_tambah.tgl_lahir') }}
                            <br>
                        @endif

                        <!-- Jenis kelamin Input -->
                        <x-label for="gender" :value="__('Jenis Kelamin')" />
                        <div class="flex">
                            <x-label for="pria" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="pria" name="gender"
                                    value="pria" />
                                <div class="px-2">Pria</div>
                            </x-label>
                            <x-label for="wanita" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="wanita" name="gender"
                                    value="wanita" />
                                <div class="px-2">Wanita</div>
                            </x-label>
                        </div>
                        @if (Session::has('error_tambah.gender'))
                            {{ Session::get('error_tambah.gender') }}
                            <br>
                        @endif

                        <!-- Agama Input -->
                        <x-label for="agama" :value="__('Agama')" />
                        <x-input id="agama" type="text" name="agama" :value="old('agama')"
                            placeholder="Masukkan Agama Anda" autocomplete="off" />
                        @if (Session::has('error_tambah.agama'))
                            {{ Session::get('error_tambah.agama') }}
                            <br>
                        @endif

                        <!-- Alamat Input -->
                        <x-label for="alamat" :value="__('Alamat')" />
                        <x-input id="alamat" type="text" name="alamat" :value="old('alamat')"
                            placeholder="Masukkan Alamat Anda" autocomplete="off" />
                        @if (Session::has('error_tambah.alamat'))
                            {{ Session::get('error_tambah.alamat') }}
                            <br>
                        @endif

                        <!-- Nomor Telepon Input -->
                        <x-label for="notelp" :value="__('Nomor Telepon')" />
                        <x-input class="appearance-none" id="notelp" type="number" name="notelp" :value="old('notelp')"
                            placeholder="Masukkan Nomor Telepon Anda" autocomplete="off" />
                        @if (Session::has('error_tambah.notelp'))
                            {{ Session::get('error_tambah.notelp') }}
                            <br>
                        @endif

                        <!-- Tgl Mulai Masuk Input -->
                        <x-label for="mulaimasuk" :value="__('Tanggal Mulai Masuk')" />
                        <x-input id="mulaimasuk" type="date" name="mulaimasuk" :value="old('mulaimasuk')"
                            autocomplete="off" />
                        @if (Session::has('error_tambah.mulaimasuk'))
                            {{ Session::get('error_tambah.mulaimasuk') }}
                            <br>
                        @endif

                        <!-- Ijazah Input -->
                        <x-label for="ijazah" :value="__('Ijazah')" />
                        <x-input id="ijazah" type="text" name="ijazah" :value="old('ijazah')"
                            placeholder="Masukkan Ijazah Anda" autocomplete="off" />
                        @if (Session::has('error_tambah.ijazah'))
                            {{ Session::get('error_tambah.ijazah') }}
                            <br>
                        @endif

                        <!-- Pekerjaan Input -->
                        <x-label for="pekerjaan" :value="__('Pekerjaan')" />
                        <x-input id="title" type="text" name="title" :value="old('title')"
                            placeholder="Masukkan Pekerjaan Anda" autocomplete="off" />
                        @if (Session::has('error_tambah.pekerjaan'))
                            {{ Session::get('error_tambah.pekerjaan') }}
                            <br>
                        @endif

                        <!-- Status Kepegawaian Input -->
                        <x-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
                        <x-input id="status_kepegawaian" type="text" name="status_kepegawaian"
                            :value="old('status_kepegawaian')" placeholder="Masukkan Status Kepegawaian Anda"
                            autocomplete="off" />
                        @if (Session::has('error_tambah.status_kepegawaian'))
                            {{ Session::get('error_tambah.status_kepegawaian') }}
                            <br>
                        @endif

                        <!-- Pelatihan Input -->
                        <x-label for="pelatihan" :value="__('Pelatihan')" />
                        <x-input id="pelatihan" type="text" name="pelatihan" :value="old('pelatihan')"
                            placeholder="Masukkan Pelatihan Anda" autocomplete="off" />
                        @if (Session::has('error_tambah.pelatihan'))
                            {{ Session::get('error_tambah.pelatihan') }}
                            <br>
                        @endif

                        <!-- Foto Input -->
                        <x-label for="foto" :value="__('Foto')" />
                        <div class="flex space-x-4 items-center">
                            <img id="tambahPreviewImg"
                                src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg"
                                alt="profile image">
                            <input id="tambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
                        </div>


                        <!-- Button Input -->

                        <p
                            class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                            <input type="submit"
                                class="w-full mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200"
                                value="Simpan">

                            <button
                                class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200"
                                @click="modalAddUser = false">
                                <a href="{{ route('pegawai.index') }}">Batal</a>
                            </button>
                        </p>

                    </form>
                </div>
            </div>
        </div>
        <!-- END: Modal Tambah User -->


        <!-- START: Modal Detail User -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
            x-show="modalDetailUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-2/4 mx-2 sm:mx-auto my-10 opacity-100"
                @click.away="modalDetailUser = false" x-show="modalDetailUser"
                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">>
                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-between mt-6 mb-12">
                        <h2 class="font-semibold uppercase text-xl">Detail User</h2>
                        <button class="focus:outline-none p-2" @click="modalDetailUser = false">
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
                        <img id="detailFoto" class="h-48 w-48 rounded-full mx-auto"
                            src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="User Picture">

                    </div>
                    <div class="grid md:grid-cols-2 text-base">
                        <div class="grid grid-cols-2">
                            <div class="pr-4 py-2 font-semibold">Nama Lengkap </div>
                            <div class="pr-4 py-2" id="detailNama"></div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="pr-4 py-2 font-semibold">Username</div>
                            <div class="pr-4 py-2" id="detailUsername"></div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="pr-4 py-2 font-semibold">Jenis Kelamin</div>
                            <div class="pr-4 py-2" id="detailJenisKelamin"></div>
                        </div>
                        <div class="grid grid-cols-2">
                            <div class="pr-4 py-2 font-semibold">Role User</div>
                            <div class="pr-4 py-2" id="detailRoleUser"></div>
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
                            <div class="pr-4 py-2 font-semibold">NIK</div>
                            <div class="pr-4 py-2" id="detailNIK"></div>
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
                            <div class="pr-4 py-2 font-semibold" id="detailStatusUser">Status User</div>
                            <div class="pr-4 py-2">
                                <span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm"
                                    id="detailActive">Active</span>
                                <span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm"
                                    id="detailInActive">Inactive</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Modal Detail User -->


        <!-- START: Modal Edit User -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
            x-show="modalEditUser" x-transition:enter="transition duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100"
                @click.away="modalEditUser = false" x-show="modalEditUser"
                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">

                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-center mt-6 mb-12">
                        <h2 class="font-semibold uppercase text-2xl">Edit User</h2>
                    </header>
                    @if (count($errors) > 0)
                        <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="formEdit" action="{{ route('pegawai.prosesedit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <x-input type="hidden" id="editIdPassword" name="id" />

                        <div class="flex justify-between space-x-4">
                            <!-- Username Input -->
                            <div class="w-1/2 pr-4">
                                <x-label for="editUsername" :value="__('Username')" />
                                <x-input id="editUsername" type="text" name="username" :value="old('username')"
                                    placeholder="Masukkan Username" autofocus autocomplete="off" />
                                @if (Session::has('error_update.username'))
                                    {{ Session::get('error_update.username') }}
                                    <br>
                                @endif
                            </div>

                            <div class="w-1/2">
                                <!-- nama Input -->
                                <x-label for="editNama" :value="__('Nama Lengkap')" />
                                <x-input id="editNama" type="text" name="nama" :value="old('nama')"
                                    placeholder="Masukkan Nama Lengkap" autocomplete="off" />
                                @if (Session::has('error_update.nama'))
                                    {{ Session::get('error_update.nama') }}
                                    <br>
                                @endif
                            </div>
                        </div>

                        <!-- Role User Input -->
                        <x-label for="editId_level" :value="__('Role User')" />
                        <x-option-select id="editId_level" name="id_level">
                            <x-slot name="option" class="editRoleOption">
                                @if (!empty($role))
                                    @foreach ($role as $r)
                                        <option value="{{ $r->id }}" @if (old('id_level') == $r->id) selected @endif>
                                            {{ $r->keterangan }}</option>
                                    @endforeach
                                @endif
                            </x-slot>
                        </x-option-select>

                        <!-- NIK Input -->
                        <x-label for="editNik" :value="__('NIK (Sesuai KTP)')" />
                        <x-input id="editNik" type="text" name="nik" :value="old('nik')" placeholder="Masukkan NIK"
                            autocomplete="off" />
                        @if (Session::has('error_update.nik'))
                            {{ Session::get('error_update.nik') }}
                            <br>
                        @endif

                        <!-- Tgl Lahir Input -->
                        <x-label for="editTgl_lahir" :value="__('Tanggal Lahir')" />
                        <x-input id="editTgl_lahir" type="date" name="tgl_lahir" :value="old('tgl_lahir')"
                            autocomplete="off" />
                        @if (Session::has('error_update.tgl_lahir'))
                            {{ Session::get('error_update.tgl_lahir') }}
                            <br>
                        @endif

                        <!-- Jenis kelamin Input -->
                        <x-label for="editGender" :value="__('Jenis Kelamin')" />
                        <div class="flex">
                            <x-label for="pria" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125 editGender" type="radio" id="editPria"
                                    value="pria" name="gender" />
                                <div class="px-2">Pria</div>
                            </x-label>
                            <x-label for="wanita" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125 editGender" type="radio" id="editWanita"
                                    value="wanita" name="gender" />
                                <div class="px-2">Wanita</div>
                            </x-label>
                        </div>
                        @if (Session::has('error_update.gender'))
                            {{ Session::get('error_update.gender') }}
                            <br>
                        @endif

                        <!-- Agama Input -->
                        <x-label for="editAgama" :value="__('Agama')" />
                        <x-input id="editAgama" type="text" name="agama" :value="old('agama')"
                            placeholder="Masukkan Agama Anda" autocomplete="off" />
                        @if (Session::has('error_update.agama'))
                            {{ Session::get('error_update.agama') }}
                            <br>
                        @endif

                        <!-- Alamat Input -->
                        <x-label for="editAlamat" :value="__('Alamat')" />
                        <x-input id="editAlamat" type="text" name="alamat" :value="old('alamat')"
                            placeholder="Masukkan Alamat Anda" autocomplete="off" />
                        @if (Session::has('error_update.alamat'))
                            {{ Session::get('error_update.alamat') }}
                            <br>
                        @endif

                        <!-- Nomor Telepon Input -->
                        <x-label for="editNotelp" :value="__('Nomor Telepon')" />
                        <x-input class="appearance-none" id="editNotelp" type="number" name="notelp"
                            :value="old('notelp')" placeholder="Masukkan Nomor Telepon Anda" autocomplete="off" />
                        @if (Session::has('error_update.notelp'))
                            {{ Session::get('error_update.notelp') }}
                            <br>
                        @endif

                        <!-- Tgl Mulai Masuk Input -->
                        <x-label for="editMulaiMasuk" :value="__('Tanggal Mulai Masuk')" />
                        <x-input id="editMulaiMasuk" type="date" name="mulaimasuk" :value="old('mulaimasuk')"
                            autocomplete="off" />
                        @if (Session::has('error_update.mulaimasuk'))
                            {{ Session::get('error_update.mulaimasuk') }}
                            <br>
                        @endif

                        <!-- Ijazah Input -->
                        <x-label for="editIjazah" :value="__('Ijazah')" />
                        <x-input id="editIjazah" type="text" name="ijazah" :value="old('ijazah')"
                            placeholder="Masukkan Ijazah Anda" autocomplete="off" />
                        @if (Session::has('error_update.ijazah'))
                            {{ Session::get('error_update.ijazah') }}
                            <br>
                        @endif

                        <!-- Pekerjaan Input -->
                        <x-label for="editPekerjaan" :value="__('Pekerjaan')" />
                        <x-input id="editPekerjaan" type="text" name="title" :value="old('title')"
                            placeholder="Masukkan Pekerjaan Anda" autocomplete="off" />
                        @if (Session::has('error_update.pekerjaan'))
                            {{ Session::get('error_update.pekerjaan') }}
                            <br>
                        @endif

                        <!-- Status Kepegawaian Input -->
                        <x-label for="editStatus_kepegawaian" :value="__('Status Kepegawaian')" />
                        <x-input id="editStatus_kepegawaian" type="text" name="status_kepegawaian"
                            :value="old('status_kepegawaian')" placeholder="Masukkan Status Kepegawaian Anda"
                            autocomplete="off" />
                        @if (Session::has('error_update.status_kepegawaian'))
                            {{ Session::get('error_update.status_kepegawaian') }}
                            <br>
                        @endif

                        <!-- Pelatihan Input -->
                        <x-label for="editPelatihan" :value="__('Pelatihan')" />
                        <x-input id="editPelatihan" type="text" name="pelatihan" :value="old('pelatihan')"
                            placeholder="Masukkan Pelatihan Anda" autocomplete="off" />
                        @if (Session::has('error_update.pelatihan'))
                            {{ Session::get('error_update.pelatihan') }}
                            <br>
                        @endif

                        <!-- Status Input -->
                        <x-label for="editStatus" :value="__('Status')" />
                        <div class="flex">
                            <x-label for="active" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125 editStatus" type="radio" value="1"
                                    id="editActive" name="status" />
                                <div class="px-2">Active</div>
                            </x-label>
                            <x-label for="editInActive" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125 editStatus" type="radio" value="0"
                                    id="editInActive" name="status" />
                                <div class="px-2">InActive</div>
                            </x-label>
                        </div>
                        @if (Session::has('error_update.status'))
                            {{ Session::get('error_update.status') }}
                            <br>
                        @endif

                        <!-- Foto Input -->
                        <x-label for="foto" :value="__('Foto')" />
                        <div class="flex space-x-4 items-center">
                            <img id="editPreviewImg"
                                src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg"
                                alt="profile image">
                            <input id="editFoto" type="file" name="foto" onchange="previewFile(this, 'edit')">
                        </div>

                        <!-- Button Input -->

                        <p
                            class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                            <button type="submit" id="editSubmit"
                                class="w-full mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200">
                                Simpan
                            </button>
                            <button
                                class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200"
                                @click="modalEditUser = false">
                                <a href="{{ route('pegawai.index') }}">Batal</a>
                            </button>
                        </p>

                    </form>
                </div>
            </div>
        </div>
        <!-- END: Modal Edit User -->

        <!-- START: Modal Ganti Password -->
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto"
            x-show="modalGantiPassword" x-transition:enter="transition duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            <div class="relative sm:w-3/4 md:w-1/2 lg:w-1/3 mx-2 sm:mx-auto my-10 opacity-100"
                @click.away="modalGantiPassword = false" x-show="modalGantiPassword"
                x-transition:enter="transition transform duration-300" x-transition:enter-start="scale-0"
                x-transition:enter-end="scale-100" x-transition:leave="transition transform duration-300"
                x-transition:leave-start="scale-100" x-transition:leave-end="scale-0">

                <div class="relative bg-white shadow-lg rounded-md text-gray-900 z-20 p-8">
                    <header class="flex items-center justify-center mt-6 mb-12">
                        <h2 class="font-semibold uppercase text-2xl">Ubah Password</h2>
                    </header>
                    @if (count($errors) > 0)
                        <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200"
                            role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form>
                        <x-input type="hidden" id="updateIdPassword" />

                        <!-- Password Input -->
                        <x-label for="updatePassword" :value="__('Password')" />
                        <x-input id="updatePassword" type="password" name="password" :value="old('password')"
                            placeholder="Masukkan Password" autocomplete="off" />
                        @if (Session::has('error_update.password'))
                            {{ Session::get('error_update.password') }}
                            <br>
                        @endif

                        <!-- Password Confirmation Input -->
                        <x-label for="updatePassword_confirmation" :value="__('Re-type Password')" />
                        <x-input id="updatePassword_confirmation" type="password" name="password_confirmation"
                            :value="old('password_confirmation')" placeholder="Masukkan Ulang Password"
                            autocomplete="off" />
                        @if (Session::has('error_update.password_confirmation'))
                            {{ Session::get('error_update.password_confirmation') }}
                            <br>
                        @endif

                        <!-- Button Input -->
                        <p
                            class="flex flex-col items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                            <button id="updatePasswordSubmit"
                                class="w-full mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200">
                                Simpan
                            </button>
                            <button
                                class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200"
                                @click="modalGantiPassword = false">
                                <a href="{{ route('pegawai.index') }}">Batal</a>
                            </button>
                        </p>

                    </form>
                </div>
            </div>
        </div>
        <!-- END: Modal Ganti Password -->
    </div>

    <script>
        $(document).ready(function() {
            $('#table-data').DataTable();


            $(document).on('click', '#details', function() {
                id = $(this).data('id');
                $.ajax({
                    url: "{{ route('pegawai.detail') }}",
                    method: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(data) {
                        document.getElementById("detailNama").innerHTML = data["0"]["nama"];
                        document.getElementById("detailUsername").innerHTML = data["0"][
                            "username"
                        ];
                        document.getElementById("detailJenisKelamin").innerHTML = data["0"][
                            "gender"
                        ];
                        document.getElementById("detailRoleUser").innerHTML = data["0"]["role"];
                        document.getElementById("detailAlamat").innerHTML = data["0"]["alamat"];
                        document.getElementById("detailNoTelp").innerHTML = data["0"]["notelp"];
                        document.getElementById("detailNIK").innerHTML = data["0"]["NIK"];
                        document.getElementById("detailTglLahir").innerHTML = data["0"][
                            "tgl_lahir"
                        ];
                        document.getElementById("detailAgama").innerHTML = data["0"]["agama"];
                        if (data["0"]["foto"] != null) {
                            $("#detailFoto").attr("src", "/storage/photo/" + data["0"]["foto"]);
                        }
                        console.log("/storage/photo/" + data["0"]["foto"]);
                        if (data["0"]["status"] == 0) {
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

            $(document).on('click', '#ubahPassword', function() {
                $('#updateIdPassword').val($(this).data('id'));
            });
            $(document).on('click', '#updatePasswordSubmit', function() {
                id = $('#updateIdPassword').val();
                password = $('#updatePassword').val();
                password_confirmation = $('#updatePassword_confirmation').val();

                $.ajax({
                    url: "{{ route('pegawai.prosesubahpassword') }}",
                    method: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        id: id,
                        password: password,
                        password_confirmation: password_confirmation
                    },
                    success: function(data) {
                        window.location.replace("{{ route('pegawai.index') }}");
                    },
                    error: function(data) {}
                });
            });


            $(document).on('click', '#edit', function() {
                id = $(this).data('id');
                $('#editIdPassword').val($(this).data('id'));

                $.ajax({
                    url: "{{ route('pegawai.edit.get') }}",
                    method: "POST",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(data) {
                        // console.log(data);
                        $user = data['user']['0'];
                        $('#editUsername').val($user["username"]);
                        $('#editNama').val($user["nama"]);
                        $role = data["role"];
                        $('#editId_level').empty();
                        $i = 0;
                        $.each($role, function() {
                            if ($role[$i]["id"] == $user['id_level']) {
                                $('#editId_level').append("<option value='" + $role[$i][
                                        "id"
                                    ] + "' selected>" + $role[$i]["keterangan"] +
                                    "</option> ");
                            } else {
                                $('#editId_level').append("<option value='" + $role[$i][
                                        "id"
                                    ] + "'>" + $role[$i]["keterangan"] +
                                    "</option> ");
                            }
                            $i += 1;
                        });
                        if ($user["gender"] == "pria") {
                            $('input#editPria').attr('checked', 'checked');
                        } else {
                            $('input#editWanita').attr('checked', 'checked');
                        }
                        $('#editNik').val($user["NIK"]);
                        $('#editTgl_lahir').val($user["tgl_lahir"]);
                        $('#editAgama').val($user["agama"]);
                        $('#editAlamat').val($user["alamat"]);
                        $('#editNotelp').val($user["notelp"]);
                        $('#editMulaiMasuk').val($user["mulaimasuk"]);
                        $('#editIjazah').val($user["ijazah"]);
                        $('#editPekerjaan').val($user["title"]);
                        $('#editStatus_kepegawaian').val($user["status_kepegawaian"]);
                        $('#editPelatihan').val($user["pelatihan"]);
                        if ($user['foto'] != null) {
                            $("#editPreviewImg").attr("src", "/storage/photo/" + $user["foto"]);
                        } else {
                            $("#editPreviewImg").attr("src",
                                "https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                            );
                        }

                        if ($user["status"] == 1) {
                            $('input#editActive').attr('checked', 'checked');
                        } else {
                            $('input#editInActive').attr('checked', 'checked');
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
                    url: "{{ route('pegawai.prosesedit') }}",
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
