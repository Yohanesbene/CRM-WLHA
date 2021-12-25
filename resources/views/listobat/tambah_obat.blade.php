@extends('layouts.main')

@section('content')
<div class="container">

    <div class="row fs-3">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ url('/simpan_obat') }}" method="post" class="form-group needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="namaobat" class="form-label fs-3">Nama Obat : </label>
                    <div class="input-group">
                        <input type="text" class="form-control fs-3" name="namaobat" id="namaobat" value="{{ $obat }}" aria-label="Disabled input example" readonly required>
                        <a class="btn btn-primary" id='editNamaObat'>
                            <span class="d-block fs-2">
                                Edit nama obat <i class="fas fa-edit"></i></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-3">Jenis Form : </label>
                    <select name="tipeForm" id="tipeForm" class="form-select form-select-lg fs-3" aria-label="Default select example">
                        <option value="manual" @if($form=='manual' ) selected @endif>Isi kode secara mandiri</option>
                        <option value="auto" @if($form=='auto' ) selected @endif>Gunakan form</option>
                    </select>
                </div>
                <!-- <div class="form_kode_obat"> -->
                <?php if ($form == 'manual') : ?>
                    @include('listobat.tambah_obat_manual')
                <?php else : ?>
                    @include('listobat.tambah_obat_form')
                <?php endif; ?>
                <!-- </div> -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label fs-3">Keterangan obat :</label>
                    <input type="text" class="form-control fs-3" name="keterangan" id="keterangan" required>
                    <div class="invalid-feedback">
                        Mohon diisi
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label fs-3">Harga obat :</label>
                    <input type="number" class="form-control fs-3" name="harga" id="harga" required>
                    <div class="invalid-feedback">
                        Mohon diisi
                    </div>
                </div>
                <button type="submit" class="btn btn-primary fs-3">Simpan</button>
                <a href="{{ url('/daftar_obat') }}" class="btn btn-secondary fs-3">Batalkan</a>
            </form>
        </div>
        <div class="col-1"></div>
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

        $(document).on('click', '#namaDagang', function() {
            $('#generik').removeAttr("checked");
        });

        $(document).on('click', '#generik', function() {
            $('#namaDagang').removeAttr("checked");
        });

        $(document).on('click', '#lokal', function() {
            $('#impor').removeAttr("checked");
        });

        $(document).on('click', '#impor', function() {
            $('#lokal').removeAttr("checked");
        });

        $('#tipeForm').on('change', function() {
            var tipe_form = $(this).val();
            var nama_obat = "{{$obat}}";
            window.location = '/tambah_obat/' + tipe_form + '/' + nama_obat;
        });

        $(document).on('click', '#terdaftarNIE', function() {
            $('#TidakTerdaftarNIE').removeAttr("checked");
        });

        $(document).on('click', '#TidakTerdaftarNIE', function() {
            $('#terdaftarNIE').removeAttr("checked");
        });

        $(document).on('click', '#editNamaObat', function() {
            $('#namaobat').removeAttr("readonly");
            $(this).attr("class", "d-none");
        });
    </script>
    @endsection