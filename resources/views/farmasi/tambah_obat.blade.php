<x-app-layout>
  <div class="flex h-screen w-screen">
    <div class="w-full flex-auto bg-indigo-50 py-6 px-10">
      <div class="block rounded-md bg-white p-8">
        <header class="mb-12 flex items-center justify-center">
          <h2 class="text-2xl font-semibold uppercase">Tambah Jenis Obat Baru</h2>
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
        <form method="POST" action="{{ route('farmasi.proses_tambah_obat') }}" enctype="multipart/form-data">
          @csrf

          {{-- Nama Obat --}}
          <x-label for="nama" :value="__('Nama Obat')" />
          <x-input type="text" id="nama" name="nama" value="{{ old('nama') ? old('nama') : '' }}" placeholder=" Masukkan Nama Obat" autocomplete="off" />

          {{-- Merk Obat --}}
          @php
            $radio_label = 'Merk Obat';
            $data = [['id' => 'generik', 'value' => 'G', 'display' => 'Generik'], ['id' => 'nama_dagang', 'value' => 'D', 'display' => 'Nama Dagang']];
            $name = 'merk_obat';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label />

          {{-- Tipe Obat --}}
          @php
            $radio_label = 'Tipe Obat';
            $data = [['id' => 'bebas', 'value' => 'B', 'display' => 'Obat Bebas'], ['id' => 'bebas_terbatas', 'value' => 'T', 'display' => 'Obat Bebas Terbatas'], ['id' => 'keras', 'value' => 'K', 'display' => 'Obat Keras'], ['id' => 'psikotropika', 'value' => 'P', 'display' => 'Psikotropika'], ['id' => 'narkotika', 'value' => 'N', 'display' => 'Narkotika']];
            $name = 'tipe_obat';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label />

          {{-- asal Obat --}}
          @php
            $radio_label = 'Asal Obat';
            $data = [['id' => 'impor', 'value' => 'I', 'display' => 'Obat impor'], ['id' => 'lokal', 'value' => 'L', 'display' => 'Obat lokal']];
            $name = 'asal_obat';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label />

          {{-- No Urut Pabrik --}}
          <x-label for="no_pabrik" :value="__('Nomor Urut Pabrik')" />
          <x-input maxlength="3" type="number" id="no_pabrik" name="no_pabrik" value="{{ old('no_pabrik') ? old('no_pabrik') : '' }}" placeholder="Masukkan 3 angka nomor urut pabrik" autocomplete="off" />

          {{-- No Urut obat --}}
          <x-label for="no_obat" :value="__('Nomor Urut obat')" />
          <x-input maxlength="3" type="number" id="no_obat" name="no_obat" value="{{ old('no_obat') ? old('no_obat') : '' }}" placeholder="Masukkan 3 angka nomor urut obat" autocomplete="off" />

          {{-- Sediaan Obat --}}
          <label class="text-lg" for="kode_7">Bentuk Sediaan Obat : </label> <br>
          <select name="kode_7" class="mr-2 mb-4 w-full rounded-md border border-gray-300 px-3 py-2 text-lg placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
            <option value="" selected>--Pilih salah satu--</option>
            <option value="01">01 - Kapsul</option>
            <option value="23">23 - Powder/Serbuk Oral</option>
            <option value="43">43 - Injeksi</option>
            <option value="02">02 - Kapsul Lunak</option>
            <option value="24">24 - Bedak/Talk</option>
            <option value="44">44 - Injeksi Suspensi Kering</option>
            <option value="04">04 - Kaplet</option>
            <option value="28">28 - Gel</option>
            <option value="09">09 - Kaplet Salut Film</option>
            <option value="29">29 - Krim, Krim Steril</option>
            <option value="46">46 - Tetes Mata</option>
            <option value="10">10 - Tablet</option>
            <option value="30">30 - Salep</option>
            <option value="47">47 - Tetes Hidung</option>
            <option value="11">11 - Tablet Effervescent</option>
            <option value="31">31 - Salep Mata</option>
            <option value="48">48 - Tetes Telinga</option>
            <option value="12">12 - Tablet Hisap</option>
            <option value="32">32 - Emulsi</option>
            <option value="49">49 - Infus</option>
            <option value="14">14 - Tablet Lepas Terkontrol</option>
            <option value="33">33 - Suspensi</option>
            <option value="53">53 - Supositoria, Ovula</option>
            <option value="34">34 - Elixir</option>
            <option value="56">56 - Nasal Spray</option>
            <option value="15">15 - Tablet Salut Enterik</option>
            <option value="36">36 - Drops</option>
            <option value="58">58 - Rectal Tube</option>
            <option value="16">16 - Pil</option>
            <option value="37">37 - Sirup/Larutan</option>
            <option value="62">62 - Inhalasi</option>
            <option value="17">17 - Tablet Salut Selaput</option>
            <option value="38">38 - Suspensi Kering</option>
            <option value="63">63 - Tablet Kunyah</option>
            <option value="22">22 - Granul</option>
            <option value="41">41 - Lotion/Solution</option>
            <option value="81">81 - Tablet Dispersi</option>
          </select>

          {{-- Sediaan Obat --}}
          @php
            $radio_label = 'Kekuatan Sediaan Obat';
            $data = [['id' => 'a1', 'value' => 'A1', 'display' => 'a1'], ['id' => 'a2', 'value' => 'A2', 'display' => 'a2'], ['id' => 'a3', 'value' => 'A3', 'display' => 'a3'], ['id' => 'b1', 'value' => 'B1', 'display' => 'b1'], ['id' => 'b2', 'value' => 'B2', 'display' => 'b2'], ['id' => 'b3', 'value' => 'B3', 'display' => 'b3'], ['id' => 'c1', 'value' => 'C1', 'display' => 'c1'], ['id' => 'c2', 'value' => 'C2', 'display' => 'c2'], ['id' => 'c3', 'value' => 'C3', 'display' => 'c3']];
            $name = 'Sediaan_obat';
          @endphp
          <x-radio :data=$data :name=$name :label=$radio_label />
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
