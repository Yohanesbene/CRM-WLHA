@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row my-5 py-5">
        <div class="col-2"></div>
        <div class="col-8 fs-1 text-center">
            <span class="card-text">Apakah anda yakin akan menghapus</span>
            <div class="card mx-auto my-auto">
                <div class="card-body ">
                    <strong>{{$obat->namaobat}}</strong>
                </div>
            </div>
            <p class="card-text">dari <strong class="text-danger">seluruh</strong> daftar obat?</p>
            <form action="{{url('/delete_obat')}}" method="post">
                @csrf
                <input type="hidden" name="noobat" value="{{$obat->noobat}}">
                <input type="hidden" name="namaobat" value="{{$obat->namaobat}}">
                <button type="submit" class="fs-1 btn btn-danger">Hapus</button>
                <a href="{{url()->previous()}}" class="fs-1 btn btn-secondary">Batalkan</a>

            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>

@endsection