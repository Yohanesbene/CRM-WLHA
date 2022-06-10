<x-app-layout>
  <div class="flex h-screen w-full" x-data="{ modalAddPenghuni: false, modalDetailUser: false, modalEditPenghuni: false, modalGantiPassword: false }" :class="{ 'overflow-y-hidden': modalAddPenghuni || modalDetailUser || modalEditPenghuni || modalGantiPassword }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block p-8 bg-white rounded-md">
        <header class="flex items-center justify-center mb-12">
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

        @if (Session::get('success'))
          <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif
        <form method="POST" action="{{ route('penghuni.prosestambah') }}" enctype="multipart/form-data">
          @csrf
          <!-- nama Input -->
          <x-label for="editnama" :value="__('Nama Penghuni')" />
          <x-input invalid="{{ $errors->has('nama') ? 'true' : 'false' }}" id="editnama" type="text" name="nama" value="{{ old('nama') ? old('nama') : '' }}" placeholder=" Masukkan Nama Penghuni Baru" autocomplete="off" />
          @if (Session::has('error_update.nama'))
            {{ Session::get('error_update.nama') }}
            <br>
          @endif

          <!-- Tgl Lahir Input -->
          <x-label for="edittgl_lahir" :value="__('Tanggal Lahir')" />
          <x-input invalid="{{ $errors->has('tgl_lahir') ? 'true' : 'false' }}" id="edittgl_lahir" type="date" name="tgl_lahir" value="{{ old('tgl_lahir') ? old('tgl_lahir') : '' }}" autocomplete="off" />
          @if (Session::has('error_tambah.tgl_lahir'))
            {{ Session::get('error_tambah.tgl_lahir') }}
            <br>
          @endif

          <!-- Jenis kelamin Input -->
          <x-label for="editgender" :value="__('Jenis Kelamin')" />
          @foreach (['pria', 'wanita'] as $gender)
            <x-label invalid="{{ $errors->has('gender') ? 'true' : 'false' }}" for="edit{{ $gender }}" class="flex p-2 cursor-pointer">
              <input class="my-auto transform scale-125" type="radio" id="edit{{ $gender }}" name="gender" value="{{ $gender }}" @if (old('gender') ? old('gender') : '' == $gender) checked="checked" @endif />
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
              <x-label invalid="{{ $errors->has('agama') ? 'true' : 'false' }}" for="edit{{ $agama }}" class="flex p-2 cursor-pointer">
                <input class="my-auto transform scale-125" type="radio" id="edit{{ $agama }}" name="agama" value="{{ $agama }}" @if (old('agama') ? old('agama') : '' == $agama) checked="checked" @endif />
                <div class="px-2">{{ ucwords($agama) }}</div>
              </x-label>
            @endforeach
          </div>
          @if (Session::has('error_tambah.agama'))
            {{ Session::get('error_tambah.agama') }}
            <br>
          @endif

          <!-- asal Input -->
          <x-label for="asal_daerah" :value="__('Asal Daerah')" />
          <x-input invalid="{{ $errors->has('asal_daerah') ? 'true' : 'false' }}" id="asal_daerah" type="text" name="asal_daerah" value="{{ old('penanggung_jawab') ? old('penanggung_jawab') : '' }}"
            placeholder="Masukkan asal_daerah penghuni" autocomplete="off" />
          @if (Session::has('error_tambah.asal_daerah'))
            {{ Session::get('error_tambah.asal_daerah') }}
            <br>
          @endif

          <!-- PenanggungJawab Input -->
          <x-label for="editPenanggungJawab" :value="__('Penanggung Jawab Penghuni')" />
          <x-input invalid="{{ $errors->has('penanggung_jawab') ? 'true' : 'false' }}" id="editPenanggungJawab" type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') ? old('penanggung_jawab') : '' }}" placeholder=" Masukkan Penanggung Jawab Penghuni Baru" autocomplete="off" />
          @if (Session::has('error_update.penanggung_jawab'))
            {{ Session::get('error_update.penanggung_jawab') }}
            <br>
          @endif

          <!-- Alamat Input -->
          <x-label for="editalamat" :value="__('Alamat Penghuni')" />
          <x-input invalid="{{ $errors->has('alamat') ? 'true' : 'false' }}" id="editalamat" type="text" name="alamat" value="{{ old('alamat') ? old('alamat') : '' }}" placeholder="Masukkan Alamat Penghuni" autocomplete="off" />
          @if (Session::has('error_update.alamat'))
            {{ Session::get('error_update.alamat') }}
            <br>
          @endif

          <!-- notelp Input -->
          <x-label for="editnotelp" :value="__('Nomor Telepon Penghuni')" />
          <x-input invalid="{{ $errors->has('notelp') ? 'true' : 'false' }}" id="editnotelp" type="number" name="notelp" value="{{ old('notelp') ? old('notelp') : '' }}" placeholder="Masukkan No Telepon Penghuni" autocomplete="off" />
          @if (Session::has('error_update.notelp'))
            {{ Session::get('error_update.notelp') }}
            <br>
          @endif

          <!-- Darurat Input -->
          <x-label for="editDarurat" :value="__('Kontak Darurat Penghuni')" />
          <x-input invalid="{{ $errors->has('kontak_darurat') ? 'true' : 'false' }}" id="editDarurat" type="text" name="kontak_darurat" value="{{ old('kontak_darurat') ? old('kontak_darurat') : '' }}" placeholder=" Masukkan Kontak Darurat Penghuni Baru" autocomplete="off" />
          @if (Session::has('error_update.kontak_darurat'))
            {{ Session::get('error_update.kontak_darurat') }}
            <br>
          @endif

          <!-- notelp Input -->
          <x-label for="editnotelp_darurat" :value="__('Nomor Telepon Darurat')" />
          <x-input invalid="{{ $errors->has('notelp_darurat') ? 'true' : 'false' }}" id="editnotelp_darurat" type="number" name="notelp_darurat" value="{{ old('notelp_darurat') ? old('notelp_darurat') : '' }}" placeholder="Masukkan No Telepon Penghuni" autocomplete="off" />
          @if (Session::has('error_update.notelp_darurat'))
            {{ Session::get('error_update.notelp_darurat') }}
            <br>
          @endif

          <!-- Ruang Input -->
          <x-label for="editruang" :value="__('Ruang Rawat')" />
          <x-input invalid="{{ $errors->has('ruang') ? 'true' : 'false' }}" id="editruang" type="text" name="ruang" value="{{ old('ruang') ? old('ruang') : '' }}" placeholder="Masukkan Ruang Rawat" autocomplete="off" />
          @if (Session::has('error_update.ruang'))
            {{ Session::get('error_update.ruang') }}
            <br>
          @endif

          <!-- Foto Input -->
          <x-label for="editfoto" :value="__('Foto')" />
          <div class="flex space-x-4 items-center">
            <img id="edittambahPreviewImg" src="{{ old('foto') ? old('foto') : 'https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png' }}" class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg' alt=" profile image">
            <input id="edittambahFoto" type="file" name="foto" onchange="previewFile(this, 'edit')">
          </div>


          <!-- Button Input -->

          <p class="flex flex-col sm:flex-row items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
            <input type="submit" class="w-full sm:w-1/2 mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200" value="Simpan">

            <a href="{{ route('penghuni.index') }}" class="w-full sm:w-1/2 border px-4 py-4 rounded-md sm:ml-2 border-white text-indigo-400 font-medium text-lg hover:border-red-900 hover:text-red-900 transition duration-200">
              Kembali
            </a>
          </p>

        </form>
      </div>
    </div>
  </div>

  <script>
    function previewFile(input, change) {
      var file = $("#edittambahFoto").get(0).files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function() {
          $('#edittambahPreviewImg').attr("src", reader.result);
        }
        reader.readAsDataURL(file);
      }
    }
  </script>
</x-app-layout>
