@extends('layouts.appadmin')

@section('contents')
    ADMIN DASHBOARD

    <button type="button"><a  href="/admin/pegawai/tambah">Tambah Pegawai</a></button>
    @if (!empty($message_success))
            <ul>
                @foreach ($message_success->all() as $ms)
                    <li>{{ $ms }}</li>
                @endforeach
            </ul>
        @endif
    <div>
        @if (Session::has('message_success'))
        {{-- SUCCESS
        <script>
            console.log("<?php Session::get('message_success')?>");
            </script> --}}
            @for($i=0; $i < count(Session::get('message_success')); $i++)
            {{ Session::get('message_success')[$i] }}
            @endfor
        @endif
    </div>
@endsection
