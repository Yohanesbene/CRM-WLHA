<x-app-layout>
  {{-- @section('contents') --}}
  <div class="flex-auto bg-indigo-50 py-6 px-10">
    <div class="block rounded-md bg-white p-8">
      <div class="flex flex-nowrap gap-3">
        <div>
          <div class="flex h-48 w-48 place-content-center bg-gray-200">
            <img src="/photos/{{ $penghuni->foto }}" alt="" srcset="">
          </div>
        </div>
        <div class="leading-loose">
          <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
          <p>Kode Ruang : {{ $penghuni->ruang }}</p>
        </div>
      </div>
    </div>
    <div class="mt-8 block rounded-md bg-white p-8">
      <form action="{{ route('rekmed.simpan') }}" method="post">
        @csrf
        <input type="hidden" name="id_penghuni" value={{ $penghuni->id }}>
        <input type="hidden" name="id_pegawai" value={{ Session::get('auth_wlha.0.id') }}>


        <div class="grid grid-cols-2 gap-4 text-lg">
          @if ($bagian == 'berat_badan' || $bagian == 'all')
            @include('rekammedis.input1', ['key' => 'berat_badan', 'input_title' => 'Berat Badan', 'type' => 'number', 'satuan' => 'kg'])
          @endif
          @if ($bagian == 'suhu_badan' || $bagian == 'all')
            @include('rekammedis.input1', ['key' => 'suhu_badan', 'input_title' => 'Suhu Badan', 'type' => 'number', 'satuan' => '&deg;C'])
          @endif
          @if ($bagian == 'nadi' || $bagian == 'all')
            @include('rekammedis.input1', ['key' => 'nadi', 'input_title' => 'Denyut Nadi', 'type' => 'number', 'satuan' => 'bpm'])
          @endif
          @if ($bagian == 'spo2' || $bagian == 'all')
            @include('rekammedis.inputselect', ['key' => 'spo2', 'input_title' => 'SpO2', 'satuan' => '%', 'options' => range(71, 101, 1)])
          @endif
          @if ($bagian == 'kolesterol' || $bagian == 'all')
            @include('rekammedis.inputselect', ['key' => 'kolesterol', 'input_title' => 'Kolesterol', 'satuan' => '%', 'options' => range(71, 101, 1)])
          @endif
          @if ($bagian == 'asam_urat' || $bagian == 'all')
            @include('rekammedis.inputselect', ['key' => 'asam_urat', 'input_title' => 'Asam Urat', 'satuan' => '%', 'options' => range(71, 101, 1)])
          @endif
          @if ($bagian == 'gds' || $bagian == 'all')
            @include('rekammedis.inputselect', ['key' => 'gds', 'input_title' => 'GDS', 'satuan' => '%', 'options' => range(71, 101, 1)])
          @endif
          <div class="col-span-2 mb-1">
            <hr>
          </div>

          @if ($bagian == 'pemberian_obat' || $bagian == 'all')
            <div class="col-span-2 mb-1">
              <span class="block text-lg font-medium text-gray-900">
                Pemberian Obat
              </span>
              {{-- Nama Obat --}}
              <x-label for="id_obat" :value="__('Nama Obat')" />
              <select id="id_obat" name="id_obat" class="block w-full rounded-md border border-gray-300 px-3 py-2 text-xl placeholder-gray-400 focus:border-indigo-300 focus:outline-none focus:ring focus:ring-indigo-100">
                <option selected></option>
                @foreach ($daftar_obat as $row)
                  <option value="{{ $row->id }}">{{ $row->namaobat }} -- {{ $row->kode_slug }}</option>
                @endforeach
              </select>
              @include('rekammedis.inputselect', ['key' => 'dosis', 'input_title' => 'Dosis Obat', 'satuan' => 'Dosis', 'options' => [1, 0.5]])
            </div>
          @endif
          @if ($bagian == 'tekanan_darah' || $bagian == 'all')
            <div class="col-span-2 mb-1">
              <span class="block text-lg font-medium text-gray-900">
                Tekanan Darah
              </span>
            </div>
            @include('rekammedis.inputselect', ['key' => 'systole', 'input_title' => 'Systole', 'satuan' => '', 'options' => range(60, 201, 10)])
            @include('rekammedis.inputselect', ['key' => 'diastole', 'input_title' => 'Diastole', 'satuan' => '', 'options' => range(40, 111, 10)])
          @endif

          @if ($bagian == 'nutrisi' || $bagian == 'all')
            <div class="col-span-2 mb-1">
              <hr>
            </div>
            <div class="col-span-2 mb-1">
              <span class="block text-xl font-medium text-gray-900">
                Nutrisi
              </span>
            </div>
            @include('rekammedis.inputselect', ['key' => 'nutrisi_pagi', 'input_title' => 'Pagi', 'satuan' => 'porsi', 'options' => range(0.25, 1.1, 0.25)])
            @include('rekammedis.inputselect', ['key' => 'nutrisi_siang', 'input_title' => 'Siang', 'satuan' => 'porsi', 'options' => range(0.25, 1.1, 0.25)])
            @include('rekammedis.inputselect', ['key' => 'nutrisi_sore', 'input_title' => 'Sore', 'satuan' => 'porsi', 'options' => range(0.25, 1.1, 0.25)])
          @endif
          @if ($bagian == 'cairan' || $bagian == 'all')
            <div class="col-span-2 mb-1">
              <hr>
            </div>
            <div class="col-span-2 mb-1">
              <span class="block text-xl font-medium text-gray-900">
                Cairan
              </span>
            </div>
            @include('rekammedis.inputselect', ['key' => 'cairan_pagi', 'input_title' => 'Pagi', 'satuan' => 'ml', 'options' => range(100, 1001, 100)])
            @include('rekammedis.inputselect', ['key' => 'cairan_siang', 'input_title' => 'Siang', 'satuan' => 'ml', 'options' => range(100, 1001, 100)])
            @include('rekammedis.inputselect', ['key' => 'cairan_sore', 'input_title' => 'Sore', 'satuan' => 'ml', 'options' => range(100, 1001, 100)])

            <div class="col-span-2 mb-1">
              <hr>
            </div>
          @endif
          @if ($bagian == 'urine' || $bagian == 'all')
            <div class="col-span-2 mb-1">
              <span class="block text-xl font-medium text-gray-900">
                Urine
              </span>
              @php
                $opsi_urine = ['1 Pampers Penuh', 'Sedikit', 'Berkali-kali', '1 urinal', '0.5 urinal', '1x toilet', '2x toilet', '3x toilet'];
              @endphp
            </div>
            @include('rekammedis.inputselect', ['key' => 'urine_pagi', 'input_title' => 'Pagi', 'satuan' => '', 'options' => $opsi_urine])
            @include('rekammedis.inputselect', ['key' => 'urine_siang', 'input_title' => 'Siang', 'satuan' => '', 'options' => $opsi_urine])
            @include('rekammedis.inputselect', ['key' => 'urine_sore', 'input_title' => 'Sore', 'satuan' => '', 'options' => $opsi_urine])

            <div class="col-span-2 mb-1">
              <hr>
            </div>
          @endif
          @if ($bagian == 'bab' || $bagian == 'all')
            <div class="col-span-2 mb-1">
              <span class="block text-xl font-medium text-gray-900">
                Buang Air Besar
              </span>
              @php
                $opsi_bab = ['Sedikit', 'Banyak', '1x', '2x', 'Keras', 'Lembek'];
              @endphp
            </div>
            @include('rekammedis.inputselect', ['key' => 'bab_pagi', 'input_title' => 'Pagi', 'satuan' => '', 'options' => $opsi_bab])
            @include('rekammedis.inputselect', ['key' => 'bab_siang', 'input_title' => 'Siang', 'satuan' => '', 'options' => $opsi_bab])
            @include('rekammedis.inputselect', ['key' => 'bab_sore', 'input_title' => 'Sore', 'satuan' => '', 'options' => $opsi_bab])

            <div class="col-span-2 mb-1">
              <hr>
            </div>
          @endif
        </div>
        <button type="submit"
          class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto">Simpan
          Data</button>

        <a href={{ route('rekmed.detail', ['id' => $penghuni->id]) }}
          class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto">Batalkan</a>
      </form>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#id_obat').select2({
        placeholder: 'Pilih Salah Satu',
      });
    });
  </script>
  {{-- @endsection --}}
</x-app-layout>
