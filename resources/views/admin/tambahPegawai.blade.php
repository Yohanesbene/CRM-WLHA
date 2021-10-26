@extends('layouts.appadmin')

@section('contents')
    @if (count($errors) > 0)
    <div class="py-3 px-5 mb-4 bg-red-100 text-red-900 text-sm rounded-md border border-red-200" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="" action="{{route('admin.pegawai.prosestambah')}}" method="POST">
        {{ csrf_field() }}
    {{-- <form id="pendaftaran" class="" > --}}
        <div>
            <label class="" for="username">Username</label>
                <input class="" id="username" type="text" name="username" placeholder="Username" value="{{ old('username') }}">
<br>
                @if (Session::has('error_tambah.username'))
                        {{ Session::get('error_tambah.username')}}
                        <br>
                @endif


            <label class="" for="password">Password</label>
                <input class="" id="password"  type="password" name="password" placeholder="Password" value="{{ old('password') }}">
<br>
                @if (Session::has('error_tambah.password'))
                        {{ Session::get('error_tambah.password')}}
                        <br>
                @endif


            <label class="" for="password_confirmation">Re-Password</label>
                <input class="" id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi Password" value="{{ old('password_confirmation') }}">
<br>
                @if (Session::has('error_tambah.password_confirmation'))
                    {{ Session::get('error_tambah.password_confirmation')}}
                    <br>
                @endif

            Status
            <select id="id_level" name="id_level" class="" >
                @if (!empty($role))
                    @foreach ($role as $r)
                        <option value="{{ $r->id}}" @if (old('id_level') == $r->id) selected @endif>{{ $r->keterangan}}</option>
                    @endforeach

                @endif


            </select>
<br>
                @if (Session::has('error_tambah.id_level'))
                    {{ Session::get('error_tambah.id_level')}}
                    <br>
                @endif

            <label class="" for="nama">Nama Lengkap</label>
                <input class="" id="nama" type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}">
<br>
                @if (Session::has('error_tambah.nama'))
                    {{ Session::get('error_tambah.nama')}}
                    <br>
                @endif


            <label class="" for="nik">NIK</label>
                <input class="" id="nik" type="text" name="nik" value="{{ old('nik') }}">
<br>
                @if (Session::has('error_tambah.nik'))
                    {{ Session::get('error_tambah.nik')}}
                    <br>
                @endif


            <label class="" for="tgl_lahir">Tanggal lahir</label>
                <input class="" id="tgl_lahir" type="date" name="tgl_lahir" placeholder="YYYY-MM-DD" value="{{ old('tgl_lahir') }}">
<br>
                @if (Session::has('error_tambah.tgl_lahir'))
                    {{ Session::get('error_tambah.tgl_lahir')}}
                    <br>
                @endif


            Jenis Kelamin
            <input class="gender" type="radio" id="pria" name="gender" value='pria' checked="checked" @if(!old('gender')) checked @endif>
                <label class="" for="pria">Laki-laki</label>
            {{-- <br> --}}
            <input class="gender" type="radio" id="wanita" name="gender" value='wanita' @if(old('gender') == 'wanita') checked @endif/>
                <label class="" for="wanita">Perempuan</label>
<br>
                @if (Session::has('error_tambah.gender'))
                    {{ Session::get('error_tambah.gender')}}
                    <br>
                @endif


            <label class="" for="agama">Agama</label>
                <input class="" id="agama" type="text" name="agama" placeholder="Masukkan Agama sesuai identitas" value="{{ old('agama') }}">
<br>
                @if (Session::has('error_tambah.agama'))
                    {{ Session::get('error_tambah.agama')}}
                    <br>
                @endif


            <label class="" for="alamat">Alamat</label>
                <input class="" id="alamat" type="text" name="alamat" placeholder="Masukkan alamat" value="{{ old('alamat') }}">
<br>
                @if (Session::has('error_tambah.alamat'))
                    {{ Session::get('error_tambah.alamat')}}
                    <br>
                @endif


            <label class="" for="notelp">No Telepon / HP</label>
                <input class="" id="notelp" type="text" name="notelp" placeholder="Masukkan No telp / HP" value="{{ old('notelp') }}">
<br>
                @if (Session::has('error_tambah.notelp'))
                    {{ Session::get('error_tambah.notelp')}}
                    <br>
                @endif


            <label class="" for="mulaimasuk">Tanggal Mulai Masuk</label>
                <input class="" id="mulaimasuk" type="date" name="mulaimasuk" placeholder="YYYY-MM-DD" value="{{ old('mulaimasuk') }}">
<br>
                @if (Session::has('error_tambah.mulaimasuk'))
                    {{ Session::get('error_tambah.mulaimasuk')}}
                    <br>
                @endif


            <label class="" for="ijazah">Ijazah</label>
                <input class="" id="ijazah" type="text" name="ijazah" placeholder="" value="{{ old('ijazah') }}">
<br>
                @if (Session::has('error_tambah.ijazah'))
                    {{ Session::get('error_tambah.ijazah')}}
                    <br>
                @endif


            <label class="" for="title">Pekerjaan</label>
                <input class="" id="title" type="text" name="title" placeholder="Masukkan pekerjaan" value="{{ old('title') }}">
<br>
                @if (Session::has('error_tambah.title'))
                    {{ Session::get('error_tambah.title')}}
                    <br>
                @endif


            <label class="" for="status_kepegawaian">Status Kepegawaian</label>
                <input class="" id="status_kepegawaian" type="text" name="status_kepegawaian" placeholder="" value="{{ old('status_kepegawaian') }}">
<br>
                @if (Session::has('error_tambah.status_kepegawaian'))
                    {{ Session::get('error_tambah.status_kepegawaian')}}
                    <br>
                @endif


            <label class="" for="pelatihan">Pelatihan</label>
                <input class="" id="pelatihan" type="text" name="pelatihan" placeholder="" value="{{ old('pelatihan') }}">
<br>
                @if (Session::has('error_tambah.pelatihan'))
                    {{ Session::get('error_tambah.pelatihan')}}
                    <br>
                @endif

{{-- //KURANG FOTO --}}

            <button id="button-submit" type="submit" class="">DAFTARKAN</button>
        </div>
    </form>
@endsection
