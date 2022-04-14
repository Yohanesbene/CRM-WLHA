<x-app-user-layout>
    {{-- @section('contents') --}}
    <div class="flex-auto bg-indigo-50 py-6 px-10">
        <div class="block p-8 bg-white rounded-md">
            <div class="flex flex-nowrap gap-3">
                <div>
                    <div class="w-48 h-48 bg-gray-200">

                    </div>
                </div>
                <div class="leading-loose">
                    <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
                    <p>Kode Ruang : {{ $penghuni->ruang }}</p>
                </div>
            </div>
        </div>
        <div class="block p-8 bg-white rounded-md mt-8">
            <form action="{{ route('user.mcu.simpan') }}" method="post">
                @csrf
                <input type="hidden" name="id_penghuni" value={{ $penghuni->id }}>
                <input type="hidden" name="id_pegawai" value={{ Session::get('auth_wlha.0.id') }}>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-6">
                        <label for="berat_badan" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Berat Badan
                        </label>
                        <div class="flex">
                            <input type="number" step=".01" id="berat_badan" name="berat_badan" max="999"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="65.23" oninvalid="this.setCustomValidity('Angka maksimum 999')"
                                onkeypress="this.setCustomValidity('')">
                            <span
                                class="inline-flex items-center px-3 text-gray-900 bg-gray-200 rounded-r-lg border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                kg
                            </span>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="nadi" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Denyut Nadi
                        </label>
                        <div class="flex">
                            <input type="number" step=".01" id="nadi" name="nadi" max="999"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="65" oninvalid="this.setCustomValidity('Angka maksimum 999')"
                                onkeypress="this.setCustomValidity('')">
                            <span
                                class="inline-flex items-center px-3 text-gray-900 bg-gray-200 rounded-r-lg border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                bpm
                            </span>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="suhu_badan" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Suhu Tubuh
                        </label>
                        <div class="flex">
                            <input type="number" step=".01" id="suhu_badan" name="suhu_badan" max="999"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="37.5" oninvalid="this.setCustomValidity('Angka maksimum 999')"
                                onkeypress="this.setCustomValidity('')">
                            <span
                                class="inline-flex items-center px-3 text-gray-900 bg-gray-200 rounded-r-lg border border-r-0 border-gray-300 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                &deg;C
                            </span>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="spo2" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            SpO2
                        </label>
                        <select id="spo2" name="spo2"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 71; $i < 101; $i++)
                                <option value="{{ $i }}">{{ $i }}%</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                    <div class="mb-1 col-span-2">
                        <span class="block font-medium text-lg text-gray-900 dark:text-gray-300">
                            Tekanan Darah
                        </span>
                    </div>
                    <div class="mb-6">
                        <label for="systole" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Systole
                        </label>
                        <select id="systole" name="systole"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 60; $i < 201; $i = $i + 10)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="diastole" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Diastole
                        </label>
                        <select id="diastole" name="diastole"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 40; $i < 111; $i = $i + 10)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                    <div class="mb-1 col-span-2">
                        <span class="block font-medium text-lg text-gray-900 dark:text-gray-300">
                            Makan
                        </span>
                    </div>
                    <div class="mb-6">
                        <label for="makan_pagi" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Pagi
                        </label>
                        <select id="makan_pagi" name="makan_pagi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 0.25; $i < 1.1; $i = $i + 0.25)
                                <option value="{{ $i }}">{{ $i }} Porsi</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="makan_siang" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Siang
                        </label>
                        <select id="makan_siang" name="makan_siang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 0.25; $i < 1.1; $i = $i + 0.25)
                                <option value="{{ $i }}">{{ $i }} Porsi</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="makan_sore" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Sore
                        </label>
                        <select id="makan_sore" name="makan_sore"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 0.25; $i < 1.1; $i = $i + 0.25)
                                <option value="{{ $i }}">{{ $i }} Porsi</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                    <div class="mb-1 col-span-2">
                        <span class="block font-medium text-lg text-gray-900 dark:text-gray-300">
                            Minum
                        </span>
                    </div>
                    <div class="mb-6">
                        <label for="minum_pagi" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Pagi
                        </label>
                        <select id="minum_pagi" name="minum_pagi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 100; $i < 1001; $i = $i + 100)
                                <option value="{{ $i }}">{{ $i }} ml</option>`
                            @endfor
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="minum_siang" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Siang
                        </label>
                        <select id="minum_siang" name="minum_siang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 100; $i < 1001; $i = $i + 100)
                                <option value="{{ $i }}">{{ $i }} ml</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="minum_sore" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Sore
                        </label>
                        <select id="minum_sore" name="minum_sore"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @for ($i = 100; $i < 1001; $i = $i + 100)
                                <option value="{{ $i }}">{{ $i }} ml</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                    <div class="mb-1 col-span-2">
                        <span class="block font-medium text-lg text-gray-900 dark:text-gray-300">
                            Urine
                        </span>
                        @php
                            $opsi_urine = ['1 Pampers Penuh', 'Sedikit', 'Berkali-kali', '1 urinal', '0.5 urinal', '1x toilet', '2x toilet', '3x toilet'];
                        @endphp
                    </div>
                    <div class="mb-6">
                        <label for="urine_pagi" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Pagi
                        </label>
                        <select id="urine_pagi" name="urine_pagi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>

                            @foreach ($opsi_urine as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="urine_siang" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Siang
                        </label>
                        <select id="urine_siang" name="urine_siang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @foreach ($opsi_urine as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="urine_sore" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Sore
                        </label>
                        <select id="urine_sore" name="urine_sore"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @foreach ($opsi_urine as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                    <div class="mb-1 col-span-2">
                        <span class="block font-medium text-lg text-gray-900 dark:text-gray-300">
                            Buang Air Besar
                        </span>
                        @php
                            $opsi_bab = ['Sedikit', 'Banyak', '1x', '2x', 'Keras', 'Lembek'];
                        @endphp
                    </div>
                    <div class="mb-6">
                        <label for="bab_pagi" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Pagi
                        </label>
                        <select id="bab_pagi" name="bab_pagi"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>

                            @foreach ($opsi_bab as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="bab_siang" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Siang
                        </label>
                        <select id="bab_siang" name="bab_siang"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @foreach ($opsi_bab as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label for="bab_sore" class="block mb-2 font-medium text-gray-900 dark:text-gray-300">
                            Sore
                        </label>
                        <select id="bab_sore" name="bab_sore"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Pilih Salah Satu</option>
                            @foreach ($opsi_bab as $i)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1 col-span-2">
                        <hr>
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan
                    Data</button>

                <a href={{ url()->previous() }}
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Batalkan</a>
            </form>
        </div>
    </div>
    {{-- @endsection --}}
</x-app-user-layout>
