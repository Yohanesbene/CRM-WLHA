<x-app-layout>
  <div class="flex h-screen w-screen">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Edit Obat</h2>
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
        <form method="POST" action="{{ route('farmasi.proses_edit_obat') }}" enctype="multipart/form-data">
          @csrf
          {{-- ID Obat --}}
          <x-input type="hidden" name="id" value="{{ $obat->id }}"></x-input>

          {{-- Nama Obat --}}
          <x-label for="namaobat" :value="__('Nama Obat')" />
          <x-input type="text" id="namaobat" name="namaobat" value="{{ old('namaobat', $obat->namaobat) ? old('namaobat', $obat->namaobat) : '' }}" placeholder=" Masukkan Nama Obat" autocomplete="off" />

          {{-- Merk Obat --}}
          @php
            $radio_label = 'Merk Obat';
            $data = [['id' => 'generik', 'value' => 'G', 'display' => 'Generik'], ['id' => 'nama_dagang', 'value' => 'D', 'display' => 'Nama Dagang']];
            $name = 'kode_1';
            $selected = $obat->kode_1;
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label :selected=$selected />

          {{-- Tipe Obat --}}
          @php
            $radio_label = 'Tipe Obat';
            $data = [['id' => 'bebas', 'value' => 'B', 'display' => 'Obat Bebas'], ['id' => 'bebas_terbatas', 'value' => 'T', 'display' => 'Obat Bebas Terbatas'], ['id' => 'keras', 'value' => 'K', 'display' => 'Obat Keras'], ['id' => 'psikotropika', 'value' => 'P', 'display' => 'Psikotropika'], ['id' => 'narkotika', 'value' => 'N', 'display' => 'Narkotika']];
            $name = 'kode_2';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label :selected="$obat->kode_2" />

          {{-- asal Obat --}}
          @php
            $radio_label = 'Asal Obat';
            $data = [['id' => 'impor', 'value' => 'I', 'display' => 'Obat impor'], ['id' => 'lokal', 'value' => 'L', 'display' => 'Obat lokal']];
            $name = 'kode_3';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label :selected="$obat->kode_3" />

          {{-- Tahun Registrasi --}}
          <x-label for="kode_4" :value="__('Tahun Registrasi')" />
          <x-input min="0" max="99" type="number" id="kode_4" name="kode_4" value="{{ old('kode_4', $obat->kode_4) ? old('kode_4', $obat->kode_4) : '' }}" placeholder="Masukkan 2 angka tahun registrasi" autocomplete="off" />

          {{-- No Urut Pabrik --}}
          <x-label for="kode_5" :value="__('Nomor Urut Pabrik')" />
          <x-input maxlength="3" type="number" id="kode_5" name="kode_5" value="{{ old('kode_5', $obat->kode_5) ? old('kode_5', $obat->kode_5) : '' }}" placeholder="Masukkan 3 angka nomor urut pabrik" autocomplete="off" />

          {{-- No Urut obat --}}
          <x-label for="kode_6" :value="__('Nomor Urut obat')" />
          <x-input maxlength="2" type="number" id="kode_6" name="kode_6" value="{{ old('kode_6', $obat->kode_6) ? old('kode_6', $obat->kode_6) : '' }}" placeholder="Masukkan 3 angka nomor urut obat" autocomplete="off" />

          {{-- Sediaan Obat --}}
          <div>
            <label class="text-lg" for="kode_7">Bentuk Sediaan Obat : </label> <br>
            <select id="kode_7" name="kode_7" class="mr-2 mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-lg placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
              @foreach (array_keys($kode_7_opt) as $key)
                <option value={{ $key }} {{ $key == $obat->kode_7 ? 'selected' : '' }}>{{ $kode_7_opt[$key] }}</option>
              @endforeach
            </select>
          </div>
          {{-- Sediaan Obat --}}
          @php
            $radio_label = 'Kekuatan Sediaan Obat';
            $data = [['id' => 'a', 'value' => 'A', 'display' => 'a'], ['id' => 'b', 'value' => 'B', 'display' => 'b'], ['id' => 'c', 'value' => 'C', 'display' => 'c']];
            $name = 'kode_8';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label :selected="$obat->kode_8" />

          {{-- Bentuk Kemasan Obat --}}
          @php
            $radio_label = 'Bentuk Kemasan Obat';
            $data = [['id' => '1', 'value' => '1', 'display' => '1'], ['id' => '2', 'value' => '2', 'display' => '2'], ['id' => '3', 'value' => '3', 'display' => '3']];
            $name = 'kode_9';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label :selected="$obat->kode_9" />
          <!-- Button Input -->
          <p class="mt-4 mb-6 flex flex-col items-center justify-center space-y-6 text-center text-lg text-gray-500 sm:flex-row">
            <input type="submit" class="mt-6 w-full items-center rounded-md bg-indigo-400 px-4 py-4 font-semibold text-white shadow-md transition duration-200 hover:bg-indigo-600 sm:mr-2 sm:w-1/2" value="Simpan">
            <a href="{{ route('farmasi.index') }}" class="w-full rounded-md border border-white px-4 py-4 text-lg font-medium text-indigo-400 transition duration-200 hover:border-red-900 hover:text-red-900 sm:ml-2 sm:w-1/2">
              Batal
            </a>
          </p>
        </form>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#kode_7').select2({
        placeholder: 'Pilih Salah Satu'
      });

      $(document).on('change', '#kode_4', () => {
        if (parseInt(this.value, 10) < 10) this.value = '0' + this.value;
      })
    });
  </script>
</x-app-layout>
