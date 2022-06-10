<x-app-layout>
  <div class="flex h-screen w-full ">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <div class="block p-8 bg-white rounded-md">
        <header class="flex items-center justify-center mb-12">
          <h2 class="font-semibold uppercase text-2xl">Tambah User</h2>
        </header>
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
        <form method="POST" action="{{ route('pegawai.prosestambah') }}"
          enctype="multipart/form-data">
          @csrf

          <div class="flex justify-between space-x-4">
            <!-- Username Input -->
            <div class="w-1/2 pr-4">
              <x-label for="username" :value="__('Username')" />
              <x-input id="username" type="text" name="username" :value="old('username')"
                placeholder="Masukkan Username" autofocus autocomplete="off" />
              @if (Session::has('error_update.username'))
                {{ Session::get('error_update.username') }}
                <br>
              @endif
            </div>
            <div class="w-1/2">
              <!-- nama Input -->
              <x-label for="nama" :value="__('Nama Lengkap')" />
              <x-input id="nama" type="text" name="nama" :value="old('nama')"
                placeholder="Masukkan Nama Lengkap" autocomplete="off" />
              @if (Session::has('error_update.nama'))
                {{ Session::get('error_update.nama') }}
                <br>
              @endif
            </div>
          </div>

          <!-- Password Input -->
          <x-label for="password" :value="__('Password')" />
          <x-input id="password" type="password" name="password" :value="old('password')"
            placeholder="Masukkan Password" autocomplete="off" />
          @if (Session::has('error_tambah.password'))
            {{ Session::get('error_tambah.password') }}
            <br>
          @endif

          <!-- Password Confirmation Input -->
          <x-label for="password_confirmation" :value="__('Re-type Password')" />
          <x-input id="password_confirmation" type="password" name="password_confirmation"
            :value="old('password_confirmation')" placeholder="Masukkan Ulang Password"
            autocomplete="off" />
          @if (Session::has('error_tambah.password_confirmation'))
            {{ Session::get('error_tambah.password_confirmation') }}
            <br>
          @endif

          <!-- Role User Input -->
          <x-label for="id_level" :value="__('Role User')" />
          <x-option-select id="id_level" name="id_level">
            <x-slot name="option">
              @if (!empty($role))
                @foreach ($role as $r)
                  <option value="{{ $r->id }}" @if (old('id_level') == $r->id) selected @endif>
                    {{ $r->keterangan }}</option>
                @endforeach
              @endif
            </x-slot>
          </x-option-select>

          <!-- NIK Input -->
          <x-label for="nik" :value="__('NIK (Sesuai KTP)')" />
          <x-input id="nik" type="text" name="nik" :value="old('nik')" placeholder="Masukkan NIK"
            autocomplete="off" />
          @if (Session::has('error_tambah.nik'))
            {{ Session::get('error_tambah.nik') }}
            <br>
          @endif

          <!-- Tgl Lahir Input -->
          <x-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
          <x-input id="tgl_lahir" type="date" name="tgl_lahir" :value="old('tgl_lahir')"
            autocomplete="off" />
          @if (Session::has('error_tambah.tgl_lahir'))
            {{ Session::get('error_tambah.tgl_lahir') }}
            <br>
          @endif

          <!-- Jenis kelamin Input -->
          <x-label for="gender" :value="__('Jenis Kelamin')" />
          <div class="flex">
            <x-label for="pria" class="flex p-2 cursor-pointer">
              <input class="my-auto transform scale-125" type="radio" id="pria" name="gender"
                value="pria" />
              <div class="px-2">Pria</div>
            </x-label>
            <x-label for="wanita" class="flex p-2 cursor-pointer">
              <input class="my-auto transform scale-125" type="radio" id="wanita" name="gender"
                value="wanita" />
              <div class="px-2">Wanita</div>
            </x-label>
          </div>
          @if (Session::has('error_tambah.gender'))
            {{ Session::get('error_tambah.gender') }}
            <br>
          @endif

          <!-- Agama Input -->
          <x-label for="agama" :value="__('Agama')" />
          <div class="flex flex-wrap">
            @foreach (['katolik', 'kristen', 'islam', 'hindu', 'budha', 'khonghucu', 'kepercayaan'] as $agama)
              <x-label for="{{ $agama }}" class="flex p-2 cursor-pointer">
                <input class="my-auto transform scale-125" type="radio" id="{{ $agama }}" name="agama"
                  value="{{ $agama }}" checked="{{ old('agama') == $agama ? checked : null }}" />
                <div class="px-2">{{ ucfirst($agama) }}</div>
              </x-label>
            @endforeach
          </div>
          @if (Session::has('error_tambah.agama'))
            {{ Session::get('error_tambah.agama') }}
            <br>
          @endif

          <!-- Alamat Input -->
          <x-label for="alamat" :value="__('Alamat')" />
          <x-input id="alamat" type="text" name="alamat" :value="old('alamat')"
            placeholder="Masukkan Alamat Anda" autocomplete="off" />
          @if (Session::has('error_tambah.alamat'))
            {{ Session::get('error_tambah.alamat') }}
            <br>
          @endif

          <!-- Nomor Telepon Input -->
          <x-label for="notelp" :value="__('Nomor Telepon')" />
          <x-input class="appearance-none" id="notelp" type="number" name="notelp" :value="old('notelp')"
            placeholder="Masukkan Nomor Telepon Anda" autocomplete="off" />
          @if (Session::has('error_tambah.notelp'))
            {{ Session::get('error_tambah.notelp') }}
            <br>
          @endif

          <!-- Tgl Mulai Masuk Input -->
          <x-label for="mulaimasuk" :value="__('Tanggal Mulai Masuk')" />
          <x-input id="mulaimasuk" type="date" name="mulaimasuk" :value="old('mulaimasuk')"
            autocomplete="off" />
          @if (Session::has('error_tambah.mulaimasuk'))
            {{ Session::get('error_tambah.mulaimasuk') }}
            <br>
          @endif

          <!-- Ijazah Input -->
          <x-label for="ijazah" :value="__('Ijazah')" />
          <x-input id="ijazah" type="text" name="ijazah" :value="old('ijazah')"
            placeholder="Masukkan Ijazah Anda" autocomplete="off" />
          @if (Session::has('error_tambah.ijazah'))
            {{ Session::get('error_tambah.ijazah') }}
            <br>
          @endif

          <!-- Pekerjaan Input -->
          <x-label for="pekerjaan" :value="__('Pekerjaan')" />
          <x-input id="title" type="text" name="title" :value="old('title')"
            placeholder="Masukkan Pekerjaan Anda" autocomplete="off" />
          @if (Session::has('error_tambah.pekerjaan'))
            {{ Session::get('error_tambah.pekerjaan') }}
            <br>
          @endif

          <!-- Status Kepegawaian Input -->
          <x-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
          <x-input id="status_kepegawaian" type="text" name="status_kepegawaian"
            :value="old('status_kepegawaian')" placeholder="Masukkan Status Kepegawaian Anda"
            autocomplete="off" />
          @if (Session::has('error_tambah.status_kepegawaian'))
            {{ Session::get('error_tambah.status_kepegawaian') }}
            <br>
          @endif

          <!-- Pelatihan Input -->
          <x-label for="pelatihan" :value="__('Pelatihan')" />
          <x-input id="pelatihan" type="text" name="pelatihan" :value="old('pelatihan')"
            placeholder="Masukkan Pelatihan Anda" autocomplete="off" />
          @if (Session::has('error_tambah.pelatihan'))
            {{ Session::get('error_tambah.pelatihan') }}
            <br>
          @endif

          <!-- Foto Input -->
          <x-label for="foto" :value="__('Foto')" />
          <div class="flex space-x-4 items-center">
            <img id="tambahPreviewImg"
              src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
              class="object-cover w-40 h-40 rounded-full shadow border-2 border-gray-300 border-dashed previewImg"
              alt="profile image">
            <input id="tambahFoto" type="file" name="foto" onchange="previewFile(this, 'tambah')">
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
