@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row my-5 py-5">
        <div class="col-2"></div>
        <div class="col-8 fs-1 text-center">
            <span class="card-text">Apakah anda yakin akan menghapus</span>
            <div class="card mx-auto my-auto">
                <div class="card-body ">
                    <table class="table table-borderless text-start">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">{{$transaksi->namaobat}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Keterangan</td>
                                <td> : </td>
                                <td>{{$transaksi->keterangan}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Stok</td>
                                <td> : </td>
                                <td>{{$transaksi->stokobat}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal</td>
                                <td> : </td>
                                <td>{{$transaksi->created_at}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <p class="card-text">dari <strong class="text-danger">daftar transaksi</strong>?</p>
            <form action="{{url('/delete_stok')}}" method="post">
                @csrf
                <?php if (isset($trans_all)) {
                    if ($trans_all == 1) {
                        echo "<input type='hidden' name='trans_all' value='{{$trans_all}}'>";
                    }
                } ?>
                <input type="hidden" name="id" value="{{$transaksi->id}}">
                <input type="hidden" name="id_obat" value="{{$transaksi->id_obat}}">
                <button type="submit" class="fs-1 btn btn-danger">Hapus</button>
                <a href="{{url()->previous()}}" class="fs-1 btn btn-secondary">Batalkan</a>

            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>

@endsection