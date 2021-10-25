@extends('layouts.appadmin')

@section('contents')
    ADMIN DASHBOARD <br>
    YANG LOGIN SIAPA ? <br>
    -------------------------------------------------------------------------------------------------<br>
    {{ Session::get('auth_wlha')->pluck('id')[0] }} <br>
    -------------------------------------------------------------------------------------------------<br>

    <button type="button"><a  href="{{route('admin.pegawai.tambah')}}">Tambah Pegawai</a></button>
    <button type="button"><a  href="{{route('admin.pegawai.ubahpassword')}}">Ubah Password</a></button>
    <button type="button"><a  href="{{route('auth.logout')}}">Logout</a></button>
    <div>
        @if (Session::has('message_success'))
            @for($i=0; $i < count(Session::get('message_success')); $i++)
            {{ Session::get('message_success')[$i] }}
            @endfor
        @endif
    </div>
@endsection
