@extends('layouts.appadmin')
@section('contents')
@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
<form class="" action="/admin/pegawai/ubahpassword/proses" method="POST">
    {{ csrf_field() }}
    <label for="id_atau_username">ID / Username / NIK</label>
    <input list="id_atau_usernames" name="id_atau_username" id="id_atau_username" value="{{ old('id_atau_username') }}">
    <datalist id="id_atau_usernames">
        @if (!empty($username))
            @foreach ($username as $u)
                <option value="{{ $u->id }}" @if (old('id_atau_username') == $u->id ) selected; @endif>{{ $u->username }}</option>
            @endforeach
        @endif
    </datalist>
<br>
    @if (Session::has('error_ubahpassword.id_atau_username'))
            {{ Session::get('error_ubahpassword.id_atau_username')}}
            <br>
    @endif
  <label class="" for="password">Password</label>
        <input class="" id="password"  type="password" name="password" placeholder="Password" value="{{ old('password') }}">
<br>
        @if (Session::has('error_ubahpassword.password'))
                {{ Session::get('error_ubahpassword.password')}}
                <br>
        @endif
    <label class="" for="password_confirmation">Re-Password</label>
        <input class="" id="password_confirmation" type="password" name="password_confirmation" placeholder="Ulangi Password" value="{{ old('password_confirmation') }}">
<br>
        @if (Session::has('error_ubahpassword.password_confirmation'))
            {{ Session::get('error_ubahpassword.password_confirmation')}}
            <br>
        @endif
        <button id="button-submit" type="submit" class="">UBAH PASSWORD</button>
</form>
@endsection
