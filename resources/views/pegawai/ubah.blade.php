<x-app-layout>
    <div class="flex h-screen w-full ">
        <div class="flex-auto bg-indigo-50 py-6 px-10">
            <div class="block p-8 bg-white rounded-md">
                <h2 class="font-semibold uppercase text-2xl">Edit Pegawai</h2>
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
                {{-- {{ dd($user[0]) }} --}}
                <form method="POST" action="{{ route('pegawai.prosesubah') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- NIP Input -->
                    <x-label for="id" :value="__('Nomor Induk Pegawai')" />
                    <x-input class="bg-gray-100" id="id" type="text" name="id" value="{{ old('id') !== null ? old('id') : $user[0]->id }}" readonly />
                    <!-- nama Input -->
                    <x-label for="nama" :value="__('Nama Lengkap')" />
                    <x-input id="nama" type="text" name="nama" value="{{ old('nama') !== null ? old('nama') : $user[0]->nama }}"
                        placeholder="Masukkan Nama Lengkap" autocomplete="off" />
                    @if (Session::has('error_update.nama'))
                        {{ Session::get('error_update.nama') }}
                        <br>
                    @endif

                    <!-- NIK Input -->
                    <x-label for="nik" :value="__('NIK (Sesuai KTP)')" />
                    <x-input id="nik" type="text" name="nik" value="{{ old('nik') !== null ? old('nik') : $user[0]->NIK }}"
                        placeholder="Masukkan NIK" autocomplete="off" />
                    @if (Session::has('error_tambah.nik'))
                        {{ Session::get('error_tambah.nik') }}
                        <br>
                    @endif

                    <!-- Tgl Lahir Input -->
                    <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                    <x-input id="tgl_lahir" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') !== null ? old('tgl_lahir') : $user[0]->tgl_lahir }}"
                        autocomplete="off" />
                    @if (Session::has('error_tambah.tgl_lahir'))
                        {{ Session::get('error_tambah.tgl_lahir') }}
                        <br>
                    @endif

                    <!-- Jenis kelamin Input -->
                    <x-label for="gender" :value="__('Jenis Kelamin')" />
                    <div class="flex flex-wrap">
                        @foreach (['pria', 'wanita'] as $gender)
                            <x-label for="{{ $gender }}" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="{{ $gender }}" name="gender"
                                    value="{{ $gender }}" checked="{{ old('gender') == $gender || $user[0]->gender == $gender ? 'checked' : null }}" />
                                <div class="px-2">{{ ucfirst($gender) }}</div>
                            </x-label>
                        @endforeach
                    </div>
                    @if (Session::has('error_tambah.gender'))
                        {{ Session::get('error_tambah.gender') }}
                        <br>
                    @endif

                    <!-- Agama Input -->
                    <x-label for="agama" :value="__('Agama')" />
                    <div class="flex flex-wrap">
                        @foreach (['katolik', 'kristen', 'islam', 'hindu', 'budha', 'khonghucu', 'kepercayaan'] as $agama)
                            <x-label for="{{ $agama }}" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="{{ $agama }}" name="agama"
                                    value="{{ $agama }}" checked="{{ old('agama') == $agama || $user[0]->agama == $agama ? 'checked' : null }}" />
                                <div class="px-2">{{ ucfirst($agama) }}</div>
                            </x-label>
                        @endforeach
                    </div>
                    @if (Session::has('error_tambah.agama'))
                        {{ Session::get('error_tambah.agama') }}
                        <br>
                    @endif

                    <!-- Alamat Input -->
                    <x-label for="alamat" :value="__('Alamat')" />
                    <x-input id="alamat" type="text" name="alamat" value="{{ old('alamat') !== null ? old('alamat') : $user[0]->alamat }}"
                        placeholder="Masukkan Alamat Anda" autocomplete="off" />
                    @if (Session::has('error_tambah.alamat'))
                        {{ Session::get('error_tambah.alamat') }}
                        <br>
                    @endif

                    <!-- Nomor Telepon Input -->
                    <x-label for="notelp" :value="__('Nomor Telepon')" />
                    <x-input class="appearance-none" id="notelp" type="number" name="notelp" value="{{ old('notelp') !== null ? old('notelp') : $user[0]->notelp }}"
                        placeholder="Masukkan Nomor Telepon Anda" autocomplete="off" />
                    @if (Session::has('error_tambah.notelp'))
                        {{ Session::get('error_tambah.notelp') }}
                        <br>
                    @endif

                    <!-- Tgl Mulai Masuk Input -->
                    <x-label for="mulaimasuk" :value="__('Tanggal Mulai Masuk')" />
                    <x-input id="mulaimasuk" type="date" name="mulaimasuk" value="{{ old('mulaimasuk') !== null ? old('mulaimasuk') : $user[0]->mulaimasuk }}"
                        autocomplete="off" />
                    @if (Session::has('error_tambah.mulaimasuk'))
                        {{ Session::get('error_tambah.mulaimasuk') }}
                        <br>
                    @endif

                    <!-- Ijazah Input -->
                    <x-label for="ijazah" :value="__('Ijazah')" />
                    <x-input id="ijazah" type="text" name="ijazah" value="{{ old('ijazah') !== null ? old('ijazah') : $user[0]->ijazah }}"
                        placeholder="Masukkan Ijazah Anda" autocomplete="off" />
                    @if (Session::has('error_tambah.ijazah'))
                        {{ Session::get('error_tambah.ijazah') }}
                        <br>
                    @endif

                    <!-- Pekerjaan Input -->
                    <x-label for="pekerjaan" :value="__('Pekerjaan')" />
                    <div class="flex flex-wrap">
                        @foreach (['Admin', 'Manajer', 'Penanggung Jawab', 'Asisten Perawat', 'Fisioterapi', 'Farmasi', 'Kantor'] as $title)
                            <x-label for="{{ $title }}" class="flex p-2 cursor-pointer">
                                <input class="my-auto transform scale-125" type="radio" id="{{ $title }}" name="title"
                                    value="{{ $title }}" checked="{{ old('title') == $title || $user[0]->title == $title ? 'checked' : null }}" />
                                <div class="px-2">{{ ucfirst($title) }}</div>
                            </x-label>
                        @endforeach
                    </div>
                    @if (Session::has('error_tambah.pekerjaan'))
                        {{ Session::get('error_tambah.pekerjaan') }}
                        <br>
                    @endif

                    <!-- Status Kepegawaian Input -->
                    <x-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
                    <x-input id="status_kepegawaian" type="text" name="status_kepegawaian"
                        value="{{ old('status_kepegawaian') !== null ? old('status_kepegawaian') : $user[0]->status_kepegawaian }}" placeholder="Masukkan Status Kepegawaian Anda"
                        autocomplete="off" />
                    @if (Session::has('error_tambah.status_kepegawaian'))
                        {{ Session::get('error_tambah.status_kepegawaian') }}
                        <br>
                    @endif

                    <!-- Pelatihan Input -->
                    <x-label for="pelatihan" :value="__('Pelatihan')" />
                    <x-input id="pelatihan" type="text" name="pelatihan" value="{{ old('pelatihan') !== null ? old('pelatihan') : $user[0]->pelatihan }}"
                        placeholder="Masukkan Pelatihan Anda" autocomplete="off" />
                    @if (Session::has('error_tambah.pelatihan'))
                        {{ Session::get('error_tambah.pelatihan') }}
                        <br>
                    @endif

                    <!-- Foto Input -->
                    <x-label for="foto" :value="__('Foto')" />
                    <div class="flex space-x-4 items-center">
                        <img id="tambahPreviewImg"
                            src="{{ $user[0]->foto != null? URL::to('/photos/' . $user[0]->foto): 'https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png' }}"
                            class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg"
                            alt="profile image">
                        <input id="tambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
                        <a href="#" class="inline-block bg-red-600 text-white p-5 rounded-md hover:bg-red-300 hover:text-black" id="hapusFoto" onclick="previewFile($('#tambahFoto'), 'hapus')">Hapus Foto</a href="#">
                    </div>


                    <!-- Button Input -->
                    <p class="flex flex-col sm:flex-row items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                        <input type="submit" class="w-full sm:w-1/2 mt-6 bg-indigo-400 sm:mr-2 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200 cursor-pointer" value="Simpan">
                        <a class="w-full sm:w-1/2 border px-4 py-4 rounded-md sm:ml-2 border-white text-indigo-400 font-medium text-lg hover:border-red-900 hover:text-red-900 transition duration-200" href="{{ route('pegawai.index') }}">Batal</a>
                    </p>

                </form>
            </div>
        </div>
    </div>

    <script>
        function previewFile(input, change) {
            if (change == "edit") {
                // var file = $("input[type=file]").get(0).files[0];
                var file = $("#editFoto").get(0).files[0];
            } else if (change == "tambah") {
                var file = $("#tambahFoto").get(0).files[0];
            }
            console.log(change);
            if (change == "hapus") {
                $('#tambahPreviewImg').attr("src", 'https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png');
                $('#tambahFoto').val(null);
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
