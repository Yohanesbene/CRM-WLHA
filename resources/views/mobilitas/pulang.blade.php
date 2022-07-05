<x-app-layout>
  <div class="flex h-screen w-full">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Tambah Kepulangan Penghuni</h2>
        </header>
        <div class="align-items-center my-4 grid grid-cols-[1fr_1fr] gap-2 text-lg md:grid-cols-[4fr_10fr]">
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
          <div class="mb-4 rounded-md border border-red-200 bg-red-100 py-3 px-5 text-sm text-red-900"
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
          <div class="flex items-center justify-between space-x-4 text-lg">
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
</x-app-layout>
