<x-app-admin-layout>
    <div class="flex h-screen w-full ">
        <div class="flex-auto bg-indigo-50 py-6 px-10">
            <div class="block p-8 bg-white rounded-md">
                <h2 class="text-3xl font-semibold text-black-400 leading-tight text-center">Tambah Penghuni Baru</h2>
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
                    <p class="flex flex-col sm:flex-row items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                        <input type="submit" class="w-full sm:w-1/2 mt-6 bg-indigo-400 sm:mr-2 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200" value="Simpan">

                        <button class="w-full sm:w-1/2 border px-4 py-4 rounded-md sm:ml-2 border-white text-indigo-400 font-medium text-lg hover:border-indigo-900 hover:text-indigo-900 transition duration-200" @click="modalAddPenghuni = false">
                            <a href="{{ route('penghuni') }}">Batal</a>
                        </button>
                    </p>

                </form>
            </div>
        </div>
    </div>
</x-app-admin-layout>
