<x-app-layout>
  <div class="flex h-screen w-full">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block p-8 bg-white rounded-md">
        <header class="flex items-center justify-center mb-12">
          <h2 class="font-semibold uppercase text-2xl">Tambah Kepulangan Penghuni</h2>
        </header>
        <div class="grid grid-cols-[1fr_1fr] md:grid-cols-[4fr_10fr] text-lg gap-2 my-4 align-items-center">
          <b>Nama Penghuni</b>
          <p>{{ $penghuni->nama }}</p>
          <b>Tujuan Keluar</b>
          <p>{{ $mobilitas->tujuan }}</p>
          <b>Tanggal dan Waktu Keluar</b>
          <p>{{ $mobilitas->keluar }}</p>
          <b>Petugas Jaga</b>
          <p>{{ $mobilitas->petugas_keluar }}</p>
        </div>
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
        <form method="POST" action="{{ route('mobilitas.tambah_pulang') }}" enctype="multipart/form-data">
          @csrf
          <div class="flex justify-between items-center space-x-4 text-lg">
            <!-- Tgl Lahir Input -->
            <input name="id" type="hidden" value="{{ $mobilitas->id }}">

            <x-label for="kembali" :value="__('Tanggal dan Waktu kembali')" />
            <x-input id="kembali" type="datetime-local" name="kembali" :value="old('kembali')"
              autocomplete="off" />
            @if (Session::has('error_tambah.kembali'))
              {{ Session::get('error_tambah.kembali') }}
              <br>
            @endif
          </div>
          <!-- Button Input -->
          <p class="flex flex-col sm:flex-row items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
            <input type="submit" class="w-full sm:w-1/2 mt-6 bg-indigo-400 sm:mr-2 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200" value="Simpan">

            <a href="{{ route('pegawai.index') }}" class="w-full sm:w-1/2 border px-4 py-4 rounded-md sm:ml-2 border-white text-indigo-400 font-medium text-lg hover:border-red-900 hover:text-red-900 transition duration-200">
              Batal
            </a>
          </p>

        </form>
      </div>
    </div>
  </div>
</x-app-layout>
