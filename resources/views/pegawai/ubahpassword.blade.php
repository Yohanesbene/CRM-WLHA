<x-app-layout>
    <div class="flex h-screen w-full ">
        <div class="flex-auto bg-indigo-50 py-6 px-10">
            <div class="block p-8 bg-white rounded-md">
                <h2 class="font-semibold text-2xl">Ubah Password</h2>
                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('pegawai.prosesubahpassword') }}">
                    <x-input type="hidden" id="updateIdPassword" />

                    <!-- Nama -->
                    <x-label for="nama" :value="__('Nama Pegawai')" />
                    <x-input class="bg-gray-100" id="nama" type="nama" name="nama" value="{{ $data->nama }}" readonly />

                    <!-- NIP -->
                    <x-label for="id" :value="__('Nomor Pegawai')" />
                    <x-input class="bg-gray-100" id="id" type="id" name="id" value="{{ $data->id }}" readonly />

                    <!-- Username -->
                    <x-label for="username" :value="__('Username')" />
                    <x-input class="bg-gray-100" id="username" type="username" name="username" value="{{ $data->username }}" readonly />

                    <!-- Password Input -->
                    <x-label for=" updatePassword" :value="__('Password Baru')" />
                    <x-input id="updatePassword" type="password" name="password" :value="old('password')"
                        placeholder="Masukkan Password" autocomplete="off" />
                    @if (Session::has('error_update.password'))
                        {{ Session::get('error_update.password') }}
                        <br>
                    @endif

                    <!-- Password Confirmation Input -->
                    <x-label for="updatePassword_confirmation" :value="__('Ulangi Password Baru')" />
                    <x-input id="updatePassword_confirmation" type="password" name="password_confirmation"
                        :value="old('password_confirmation')" placeholder="Masukkan Ulang Password"
                        autocomplete="off" />
                    @if (Session::has('error_update.password_confirmation'))
                        {{ Session::get('error_update.password_confirmation') }}
                        <br>
                    @endif

                    <!-- Button Input -->
                    <p
                        class="flex flex-col sm:flex-row items-center justify-center mt-4 text-center text-lg text-gray-500 space-y-6 mb-6">
                        <button id="updatePasswordSubmit"
                            class="w-full sm:w-1/2 mt-6 bg-indigo-400 px-4 py-4 rounded-md text-white font-semibold shadow-md items-center hover:bg-indigo-600 transition duration-200">
                            Simpan
                        </button>
                        <a href="{{ route('pegawai.index') }}"
                            class="w-full sm:w-1/2 border px-4 py-4 rounded-md sm:ml-2 border-white text-indigo-400 font-medium text-lg hover:border-red-900 hover:text-red-900 transition duration-200">
                            Batal
                        </a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
