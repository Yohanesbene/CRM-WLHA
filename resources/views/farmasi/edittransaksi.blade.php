<x-app-layout>
  <div class="flex h-screen w-full"
    x-data="{ modalDetailMobilitas: false }"
    :class="{ 'overflow-y-hidden': modalDetailMobilitas }">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Obat -->
      <div class="block rounded-md bg-white p-8">
        <h2 class="text-black-400 mb-3 text-3xl font-semibold leading-tight">Edit Transaksi Obat</h2>
        <!-- START: Data Table -->
        <div class="mt-8 flex flex-col">
          @if (Session::get('success'))
            <div class="mb-4 rounded-md border border-green-200 bg-green-100 py-3 px-5 text-sm text-green-900" role="alert">
              {{ Session::get('success') }}
            </div>
          @endif
          <form method="POST" action="{{ route('mobilitas.prosestambah') }}" enctype="multipart/form-data">
            @csrf
            {{-- Nama Obat --}}
            <x-label for="namaobat" :value="__('Nama Obat')" />
            <x-input type="text" id="namaobat" name="namaobat" value="{{ $obat->namaobat }}" placeholder=" Masukkan Total Obat" autocomplete="off" :disabled=true />

            {{-- Jumlah Stock --}}
            <x-label for="total" :value="__('Total Obat')" />
            <x-input type="number" id="total" name="total" value="{{ old('total', $history->stokobat) ? old('total', $history->stokobat) : '' }}" placeholder=" Masukkan Total Obat" autocomplete="off" />

            {{-- Keterangan --}}
            <x-label for="keterangan" :value="__('Keterangan Transaksi')" />
            <x-input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan', $history->keterangan) ? old('keterangan', $history->keterangan) : '' }}" placeholder=" Masukkan Keterangan Transaksi" autocomplete="off" />

            <!-- Button Input -->
            <p class="mt-4 mb-6 flex flex-col items-center justify-center space-y-6 text-center text-lg text-gray-500 sm:flex-row">
              <input type="submit" class="mt-6 w-full items-center rounded-md bg-indigo-400 px-4 py-4 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600 sm:mr-2 sm:w-1/2" value="Simpan">

              <a href="{{ url()->previous() }}" class="w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2">
                Batal
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#obat').select2({
        placeholder: 'Pilih Salah Satu',
      });
    });
  </script>
</x-app-layout>
