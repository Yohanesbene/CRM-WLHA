@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title fs-1">{{$obat->namaobat}}</h5>
                    <p class='fs-3'>Tambah stok obat</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row fs-3">
        <div class="col-2"></div>
        <div class="col-10">

        </div>
        <form class="needs-validation" action="{{url('/simpan_stok')}}" method="post" novalidate>
            @csrf
            <?php if ($edit) {
                $stok = $data->stokobat * $mtp;
                $keterangan = $data->keterangan;
                echo "<input type='hidden' name='id' id='hidden_page' value='$data->id' />";
            } ?>
            <?php if (isset($trans_all)) {
                if ($trans_all == 1) {
                    echo "<input type='hidden' name='trans_all' value='$trans_all' />";
                }
            }
            ?>
            <input type="hidden" name="id_obat" id="id_obat" value="{{$data->id_obat}}" />
            <div class="mb-3">
                <label for="keterangan" class="form-label fs-3">Keterangan :</label>
                <input {{($edit) ? "value=$keterangan" : ""}} type="text" class="form-control fs-3" placeholder="Pembelian melalui kurir (klik disini)" name="keterangan" id="keterangan" aria-describedby="keteranganHelp" required>
                <div id="keteranganHelp" class="form-text">Masukkan keterangan penambahan jumlah stok obat</div>
                <div class="invalid-feedback">
                    Mohon masukkan keterangan
                </div>
            </div>
            <div class="mb-3">
                <label for="stokobat" class="form-label fs-3">Jumlah stok yang ditambahkan :</label>
                <input {{($edit) ? "value=$stok" : ""}} type="number" placeholder="10 (klik disini)" class=" form-control fs-3" name="stokobat" id="stokobat" required>
                <div class="invalid-feedback">
                    Mohon masukkan jumlah berupa angka
                </div>
            </div>
            <input type="hidden" name="multiplier" id="hidden_page" value="1" />
            <button type="submit" class="btn btn-primary fs-3">Simpan</button>
            <a href="{{url()->previous()}}" class="btn btn-secondary fs-3">Kembali</a>
        </form>
    </div>
    <div class="col-2"></div>
</div>

<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection