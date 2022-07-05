<x-app-layout>
  <div class="flex h-screen w-screen">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Tambah Mobilitas Penghuni</h2>
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
        <form method="POST" action="{{ route('mobilitas.prosestambah') }}" enctype="multipart/form-data">
          @csrf
          <!-- Penghuni -->
          <div class="flex flex-col items-start justify-between">

            <x-label for="IDPenghuni" :value="__('ID Penghuni')" />
            {{-- <x-input invalid="{{ $errors->has('no_induk_penghuni') ? 'true' : 'false' }}" id="IDPenghuni" type="text" name="no_induk_penghuni" value="{{ old('no_induk_penghuni') ? old('no_induk_penghuni') : '' }}" placeholder=" Masukkan Nomor Induk Penghuni" autocomplete="off" />
                    @if (Session::has('error_update.no_induk_penghuni'))
                        {{ Session::get('error_update.no_induk_penghuni') }}
                        <br>
                    @endif --}}
            <select id="IDPenghuni" name="IDPenghuni" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-xl text-red-400 placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
              <option value=""></option>
              @foreach ($penghuni as $row)
                <option value="{{ $row->id }}">{{ $row->no_induk }} {{ $row->nama }}</option>
              @endforeach
            </select>
          </div>

          {{-- Tujuan --}}
          <div class="flex flex-col items-start justify-between">

            <x-label class="mt-2" for="edittujuan" :value="__('Tujuan Keluar')" />
            <x-input invalid="{{ $errors->has('tujuan') ? 'true' : 'false' }}" id="edittujuan" type="text" name="tujuan" value="{{ old('tujuan') ? old('tujuan') : '' }}" placeholder=" Masukkan Tujuan Keluar" autocomplete="off" />
            @if (Session::has('error_update.tujuan'))
              {{ Session::get('error_update.tujuan') }}
              <br>
            @endif
          </div>

          {{-- waktu --}}
          <div class="flex flex-col items-start justify-between">
            <!-- Tgl Lahir Input -->
            <x-label for="keluar" :value="__('Tanggal dan Waktu keluar')" />
            <x-input id="keluar" type="datetime-local" name="keluar" value="{{ $time->format('Y-m-d\Th:i') }}"
              autocomplete=" off" />
            @if (Session::has('error_tambah.keluar'))
              {{ Session::get('error_tambah.keluar') }}
              <br>
            @endif
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
    });
  </script>
</x-app-layout>
