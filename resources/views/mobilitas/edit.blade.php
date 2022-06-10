<x-app-layout>
  <div class="flex h-screen w-screen">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Edit Mobilitas Penghuni</h2>
        </header>
        @if (count($errors) > 0)
          <div class="mb-4 rounded-md border border-red-200 bg-red-100 py-3 px-5 text-sm text-red-900" role="alert">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (Session::get('success'))
          <div class="mb-4 rounded-md border border-green-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert">
            {{ Session::get('success') }}
          </div>
        @endif
        <form method="POST" action="{{ route('mobilitas.prosesedit') }}" enctype="multipart/form-data">
          @csrf
          {{-- ID Mobilitas --}}
          <input type="hidden" name="id_mobilitas" id="id_mobilitas" value={{ $mobilitas->id }}>

          {{-- Penghuni --}}
          <div class="flex flex-col items-start justify-between">

            <x-label for="IDPenghuni" :value="__('ID Penghuni')" />
            {{-- <x-input invalid="{{ $errors->has('no_induk_penghuni') ? 'true' : 'false' }}" id="IDPenghuni" type="text" name="no_induk_penghuni" value="{{ old('no_induk_penghuni') ? old('no_induk_penghuni') : '' }}" placeholder=" Masukkan Nomor Induk Penghuni" autocomplete="off" />
                    @if (Session::has('error_update.no_induk_penghuni'))
                        {{ Session::get('error_update.no_induk_penghuni') }}
                        <br>
                    @endif --}}
            <select id="IDPenghuni" name="IDPenghuni" class="w-max-full block w-full rounded-md border border-gray-300 px-3 py-2 text-xl text-red-400 placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
              @foreach ($penghuni as $row)
                <option value="{{ $row->id }}" {{ $row->id == $mobilitas->id_penghuni ? 'selected' : '' }}>{{ $row->no_induk }} {{ $row->nama }}</option>
              @endforeach
            </select>
          </div>

          {{-- Tujuan --}}
          <div class="flex flex-col items-start justify-between">

            <x-label class="mt-2" for="edittujuan" :value="__('Tujuan Keluar')" />
            <x-input invalid="{{ $errors->has('tujuan') ? 'true' : 'false' }}" id="edittujuan" type="text" name="tujuan" value="{{ old('tujuan', $mobilitas->tujuan) ? old('tujuan', $mobilitas->tujuan) : '' }}" placeholder=" Masukkan Tujuan Keluar" autocomplete="off" />
            @if (Session::has('error_update.tujuan'))
              {{ Session::get('error_update.tujuan') }}
              <br>
            @endif
          </div>

          {{-- Keluar --}}
          <div class="my-2 flex flex-col border-t-4 py-2 text-lg">
            <h2 class="my-2 font-bold">Mobilitas Keluar</h2>
            {{-- Tgl Keluar Input --}}
            <div class="flex flex-col items-start justify-between">

              <x-label for="keluar" :value="__('Tanggal dan Waktu Keluar')" />
              <x-input id="keluar" type="datetime-local" name="keluar"
                autocomplete="off" value="{{ old('keluar', $mobilitas->keluar) ? date('Y-m-d\Th:i', strtotime(old('keluar', $mobilitas->keluar))) : '' }}" />
              @if (Session::has('error_tambah.keluar'))
                {{ Session::get('error_tambah.keluar') }}
                <br>
              @endif
            </div>

            {{-- Petugas Keluar --}}
            <div class="flex flex-col items-start justify-between">
              <x-label for="petugasKeluar" :value="__('Petugas Keluar')" />
              <select id="petugasKeluar" name="petugasKeluar" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-xl text-red-400 placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
                @foreach ($pegawai as $row)
                  <option value="{{ $row->id }}" {{ $row->id == $mobilitas->petugas_keluar ? 'selected' : '' }}>{{ $row->no_induk }} {{ $row->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- Kembali --}}
          <div class="my-2 flex flex-col border-t-4 py-2 text-lg">
            <h2 class="my-2 font-bold">Mobilitas Kembali</h2>
            {{-- Tgl Kembali Input --}}
            <div class="flex flex-col items-start justify-between">
              <x-label for="kembali" :value="__('Tanggal dan Waktu Kembali')" />
              <x-input id="kembali" type="datetime-local" name="kembali"
                autocomplete=" off" value="{{ old('kembali', $mobilitas->kembali) ? date('Y-m-d\Th:i', strtotime(old('kembali', $mobilitas->kembali))) : '' }}" />
              @if (Session::has('error_tambah.kembali'))
                {{ Session::get('error_tambah.kembali') }}
                <br>
              @endif
            </div>

            {{-- Petugas Kembali --}}
            <div class="flex flex-col items-start justify-between">
              <x-label for="petugasKembali" :value="__('Petugas Kembali')" />
              <select id="petugasKembali" name="petugasKembali" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-xl text-red-400 placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
                @foreach ($pegawai as $row)
                  <option value="{{ $row->id }}" {{ $row->id == $mobilitas->petugas_kembali ? 'selected' : '' }}>{{ $row->no_induk }} {{ $row->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <!-- Button Input -->
          <p class="mt-4 mb-6 flex flex-col items-center justify-center space-y-6 text-center text-lg text-gray-500 sm:flex-row">
            <input type="submit" class="mt-6 w-full items-center rounded-md bg-indigo-400 px-4 py-4 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600 sm:mr-2 sm:w-1/2" value="Simpan">

            <a href="{{ route('mobilitas.index') }}" class="w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2">
              Batal
            </a>
          </p>
        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#IDPenghuni').select2({
        placeholder: 'Pilih Salah Satu'
      });

      $('#petugasKeluar').select2({
        placeholder: 'Pilih Salah Satu'
      });

      $('#petugasKembali').select2({
        placeholder: 'Pilih Salah Satu'
      });
    });
  </script>
</x-app-layout>
