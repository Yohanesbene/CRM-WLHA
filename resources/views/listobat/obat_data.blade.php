<style>
    @media (max-width: 767.98px) {
        #data-table {
            display: none;
        }
    }

    @media (min-width: 768px) {
        #data-card {
            display: none;
        }
    }
</style>

<?php if ($count < 1) : ?>
    <div class="card">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-xl-10 col-lg-12">
                    Obat <strong>{{$query}}</strong> tidak ditemukan. <br>
                    Tambahkan sebagai jenis obat baru?
                </div>
                <div class="col-xl-2 col-lg-12 ">
                    <a href="{{url('/tambah_obat/manual/'.$query)}}" class="fs-2 align-middle float-end btn btn-primary btn-lg">Tambahkan</a> <br>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col">
            @foreach($data as $row)
            <ul class="list-group" id="data-card">
                <li class="list-group-item">
                    <h3>{{$row->namaobat}} <br> <span class="fs-4 text-success fst-italic">{{$row->kode_slug}}</span> <br></h3>
                    Total stok : {{($row->stokobat != NULL) ? $row->stokobat : 0}} <br>
                    <a href='{{url("hapus_obat/$row->id")}}'><span class="fs-3 btn btn-danger my-1">Hapus</span></a>
                    <a href='{{url("detail_obat/$row->id")}}'><span class="fs-3 btn btn-primary my-1">Detail</span></a>
                </li>
            </ul>
            @endforeach

            <table class="table table-hover table-striped" id="data-table">
                <thead style="position: sticky;top: 0" class="bg-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <!-- <th scope="col">Tanggal</th> -->
                        <!-- <th scope="col">Deskripsi</th> -->
                        <th scope="col">Stok</th>
                        <th scope="col" class='text-center'></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td> </td>
                        <td class="lh-2"> {{$row->namaobat}} <br> <span class="fs-4 text-success fst-italic">{{$row->kode_slug}}</span></td>
                        <td class="align-middle"> {{($row->stokobat != NULL) ? $row->stokobat : 0}}</td>
                        <td class='align-middle text-center'>
                            <a href='{{url("hapus_obat/$row->id")}}'><span class="fs-3 btn btn-danger my-1">Hapus</span></a>
                            <a href='{{url("detail_obat/$row->id")}}'><span class="fs-3 btn btn-primary my-1">Detail</span></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex fs-1 justify-content-center text-center">
        {!! $data->onEachSide(1)->links() !!}
    </div>
<?php endif; ?>