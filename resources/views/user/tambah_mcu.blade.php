<x-app-user-layout>
  {{-- @section('contents') --}}
  <div class="flex-auto bg-indigo-50 py-6 px-10">
    <div class="block rounded-md bg-white p-8">
      <div class="flex flex-nowrap gap-3">
        <div>
          <div class="h-48 w-48 bg-gray-200">

          </div>
        </div>
        <div class="leading-loose">
          <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
          <p>Kode Ruang : {{ $penghuni->ruang }}</p>
        </div>
      </div>
    </div>
    <div class="mt-8 block rounded-md bg-white p-8">
      <form action="{{ route('user.mcu.simpan') }}" method="post">
        @csrf
        <input type="hidden" name="id_penghuni" value={{ $penghuni->id }}>
        <input type="hidden" name="id_pegawai" value={{ Session::get('auth_wlha.0.id') }}>
        <div class="grid grid-cols-2 gap-4">
          <div class="mb-6">
            <label for="berat_badan" class="mb-2 block font-medium text-gray-900">
              Berat Badan
            </label>
            <div class="flex">
              <input type="number" step=".01" id="berat_badan" name="berat_badan" max="999"
                class="block w-full rounded-l-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                placeholder="65.23" oninvalid="this.setCustomValidity('Angka maksimum 999')"
                onkeypress="this.setCustomValidity('')">
              <span
                class="inline-flex items-center rounded-r-lg border border-r-0 border-gray-300 bg-gray-200 px-3 text-gray-900">
                kg
              </span>
            </div>
          </div>
          <div class="mb-6">
            <label for="nadi" class="mb-2 block font-medium text-gray-900">
              Denyut Nadi
            </label>
            <div class="flex">
              <input type="number" step=".01" id="nadi" name="nadi" max="999"
                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                placeholder="65" oninvalid="this.setCustomValidity('Angka maksimum 999')"
                onkeypress="this.setCustomValidity('')">
              <span
                class="inline-flex items-center rounded-r-lg border border-r-0 border-gray-300 bg-gray-200 px-3 text-gray-900">
                bpm
              </span>
            </div>
          </div>
          <div class="mb-6">
            <label for="suhu_badan" class="mb-2 block font-medium text-gray-900">
              Suhu Tubuh
            </label>
            <div class="flex">
              <input type="number" step=".01" id="suhu_badan" name="suhu_badan" max="999"
                class="block w-full rounded-l-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                placeholder="37.5" oninvalid="this.setCustomValidity('Angka maksimum 999')"
                onkeypress="this.setCustomValidity('')">
              <span
                class="inline-flex items-center rounded-r-lg border border-r-0 border-gray-300 bg-gray-200 px-3 text-gray-900">
                &deg;C
              </span>
            </div>
          </div>
          <div class="mb-6">
            <label for="spo2" class="mb-2 block font-medium text-gray-900">
              SpO2
            </label>
            <select id="spo2" name="spo2"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 71; $i < 101; $i++)
                <option value="{{ $i }}">{{ $i }}%</option>
              @endfor
            </select>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
          <div class="col-span-2 mb-1">
            <span class="block text-lg font-medium text-gray-900">
              Tekanan Darah
            </span>
          </div>
          <div class="mb-6">
            <label for="systole" class="mb-2 block font-medium text-gray-900">
              Systole
            </label>
            <select id="systole" name="systole"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 60; $i < 201; $i = $i + 10)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="mb-6">
            <label for="diastole" class="mb-2 block font-medium text-gray-900">
              Diastole
            </label>
            <select id="diastole" name="diastole"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 40; $i < 111; $i = $i + 10)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
          <div class="col-span-2 mb-1">
            <span class="block text-lg font-medium text-gray-900">
              Nutrisi
            </span>
          </div>
          <div class="mb-6">
            <label for="nutrisi_pagi" class="mb-2 block font-medium text-gray-900">
              Pagi
            </label>
            <select id="nutrisi_pagi" name="nutrisi_pagi"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 0.25; $i < 1.1; $i = $i + 0.25)
                <option value="{{ $i }}">{{ $i }} Porsi</option>
              @endfor
            </select>
          </div>
          <div class="mb-6">
            <label for="nutrisi_siang" class="mb-2 block font-medium text-gray-900">
              Siang
            </label>
            <select id="nutrisi_siang" name="nutrisi_siang"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 0.25; $i < 1.1; $i = $i + 0.25)
                <option value="{{ $i }}">{{ $i }} Porsi</option>
              @endfor
            </select>
          </div>
          <div class="mb-6">
            <label for="nutrisi_sore" class="mb-2 block font-medium text-gray-900">
              Sore
            </label>
            <select id="nutrisi_sore" name="nutrisi_sore"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 0.25; $i < 1.1; $i = $i + 0.25)
                <option value="{{ $i }}">{{ $i }} Porsi</option>
              @endfor
            </select>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
          <div class="col-span-2 mb-1">
            <span class="block text-lg font-medium text-gray-900">
              Cairan
            </span>
          </div>
          <div class="mb-6">
            <label for="cairan_pagi" class="mb-2 block font-medium text-gray-900">
              Pagi
            </label>
            <select id="cairan_pagi" name="cairan_pagi"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 100; $i < 1001; $i = $i + 100)
                <option value="{{ $i }}">{{ $i }} ml</option>`
              @endfor
            </select>
          </div>
          <div class="mb-6">
            <label for="cairan_siang" class="mb-2 block font-medium text-gray-900">
              Siang
            </label>
            <select id="cairan_siang" name="cairan_siang"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 100; $i < 1001; $i = $i + 100)
                <option value="{{ $i }}">{{ $i }} ml</option>
              @endfor
            </select>
          </div>
          <div class="mb-6">
            <label for="cairan_sore" class="mb-2 block font-medium text-gray-900">
              Sore
            </label>
            <select id="cairan_sore" name="cairan_sore"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @for ($i = 100; $i < 1001; $i = $i + 100)
                <option value="{{ $i }}">{{ $i }} ml</option>
              @endfor
            </select>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
          <div class="col-span-2 mb-1">
            <span class="block text-lg font-medium text-gray-900">
              Urine
            </span>
            @php
              $opsi_urine = ['1 Pampers Penuh', 'Sedikit', 'Berkali-kali', '1 urinal', '0.5 urinal', '1x toilet', '2x toilet', '3x toilet'];
            @endphp
          </div>
          <div class="mb-6">
            <label for="urine_pagi" class="mb-2 block font-medium text-gray-900">
              Pagi
            </label>
            <select id="urine_pagi" name="urine_pagi"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>

              @foreach ($opsi_urine as $i)
                <option value="{{ $i }}">{{ $i }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-6">
            <label for="urine_siang" class="mb-2 block font-medium text-gray-900">
              Siang
            </label>
            <select id="urine_siang" name="urine_siang"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @foreach ($opsi_urine as $i)
                <option value="{{ $i }}">{{ $i }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-6">
            <label for="urine_sore" class="mb-2 block font-medium text-gray-900">
              Sore
            </label>
            <select id="urine_sore" name="urine_sore"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @foreach ($opsi_urine as $i)
                <option value="{{ $i }}">{{ $i }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
          <div class="col-span-2 mb-1">
            <span class="block text-lg font-medium text-gray-900">
              Buang Air Besar
            </span>
            @php
              $opsi_bab = ['Sedikit', 'Banyak', '1x', '2x', 'Keras', 'Lembek'];
            @endphp
          </div>
          <div class="mb-6">
            <label for="bab_pagi" class="mb-2 block font-medium text-gray-900">
              Pagi
            </label>
            <select id="bab_pagi" name="bab_pagi"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>

              @foreach ($opsi_bab as $i)
                <option value="{{ $i }}">{{ $i }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-6">
            <label for="bab_siang" class="mb-2 block font-medium text-gray-900">
              Siang
            </label>
            <select id="bab_siang" name="bab_siang"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @foreach ($opsi_bab as $i)
                <option value="{{ $i }}">{{ $i }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-6">
            <label for="bab_sore" class="mb-2 block font-medium text-gray-900">
              Sore
            </label>
            <select id="bab_sore" name="bab_sore"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
              <option value="" selected>Pilih Salah Satu</option>
              @foreach ($opsi_bab as $i)
                <option value="{{ $i }}">{{ $i }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-span-2 mb-1">
            <hr>
          </div>
        </div>
        <button type="submit"
          class="w-full rounded-lg bg-blue-700 px-5 py-2.5 text-center font-medium text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto">Simpan
          Data</button>

        <a href={{ url()->previous() }}
          class="w-full rounded-lg bg-red-700 px-5 py-2.5 text-center font-medium text-white hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto">Batalkan</a>
      </form>
    </div>
  </div>
  {{-- @endsection --}}
</x-app-user-layout>
