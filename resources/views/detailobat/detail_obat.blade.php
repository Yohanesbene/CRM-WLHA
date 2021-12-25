@extends('layouts.main')

@section('content')
<style>
    div.datepicker {
        font-size: 25px !important;
    }

    div.datepicker table {
        border-spacing: 90px !important;
    }

    div.datepicker th,
    div.datepicker td {
        padding-top: 5px !important;
        padding-left: 30px !important;
        padding-right: 30px !important;
        padding-bottom: 5px !important;
    }
</style>
<div class="container fs-2">
    <div class="row">
        <div class="col-12">
            <div class="card mt-4">
                <div class="row">
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title fs-1">{{$obat->namaobat}}</h5>
                            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                            <p class="card-text fs-3">Kode Obat : {{$obat->kode_slug}}</p>
                            <p class="card-text fs-3">Stok Obat : {{$obat->stokobat}}</p>
                            <a href="{{url('/tambah_stok/'.$obat->id)}}" class="card-link">Tambahkan stok</a>
                            <a href="{{url('/kurang_stok/'.$obat->id)}}" class="card-link">Kurangi stok</a>
                        </div>
                    </div>
                    <div class="col-4">
                        <a href="{{url('/daftar_obat')}}" class="mx-5 my-5 fs-1 float-end btn btn-primary">Kembali</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (session()->has('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show fs-2" role="alert">
                    {!!session()->get('message')!!}
                    <button type="button" class="align-middle btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <div class="form-group">
                <div class="input-group my-2">
                    <input type="text" name="searchKeterangan" id="searchKeterangan" class="form-control fs-2" placeholder="Cari Keterangan" />
                    <button class="btn btn-danger" id='delSearch'>
                        <span class="d-block fs-2">
                            <i class="fa fa-times"></i>
                        </span>
                    </button>
                </div>
                <span class="fst-italic text-secondary">Cara menulis tanggal manual : hh-bb-yyyy (20 Jan 2021 menjadi 20-01-2021)</span>

                <div class="input-group input-daterange  my-2">
                    <input id="fromDate" type="text" class="form-control fs-2" value="{{now()->subYear()->format('d-m-Y')}}" placeholder="Dari tanggal">

                    <span class="input-group-text fs-2">sampai</span>
                    <input id="untilDate" type="text" class="form-control fs-2" value="{{now()->format('d-m-Y')}}" placeholder="Sampai tanggal">

                    <!-- <button class="btn btn-success" id='searchDate'>
                        <span class="d-block fs-2">
                            <i class="fa fa-search"></i>
                        </span>
                    </button> -->
                    <button class="btn btn-danger" id='delDate'>
                        <span class="d-block fs-2">
                            <i class="fa fa-times"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col table-responsive" id="data-result">
            @include('detailobat/detail_data')
        </div>
    </div>
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
    <input type="hidden" name="_token" value="{{ Session::token() }}">
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

        function clear_icon() {
            $('#id_icon').html('');
            $('#post_title_icon').html('');
        }

        function fetch_data(page, query, fromDate, untilDate) {
            console.log("{{$id}}");
            $.ajax({
                url: "/detail_obat/{{$id}}/detail_data?query=" + query + "&from=" + fromDate + "&until=" + untilDate + "&page=" + page,
                type: 'GET',
                success: function(data) {
                    $('#data-result').html('');
                    $('#data-result').html(data);
                }
            })
        }

        $(document).on('keyup', '#searchKeterangan', function() {
            var query = $('#searchKeterangan').val();
            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = 1;
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        });

        $(document).on('click', '.sorting', function() {
            // var column_name = $(this).data('column_name');
            // var order_type = $(this).data('sorting_type');
            // var reverse_order = '';
            // if (order_type == 'asc') {
            //     $(this).data('sorting_type', 'desc');
            //     reverse_order = 'desc';
            //     clear_icon();
            //     $('#' + column_name + '_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
            // }
            // if (order_type == 'desc') {
            //     $(this).data('sorting_type', 'asc');
            //     reverse_order = 'asc';
            //     clear_icon
            //     $('#' + column_name + '_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
            // }
            $('#hidden_column_name').val(column_name);
            $('#hidden_sort_type').val(reverse_order);
            var page = $('#hidden_page').val();
            var query = $('#searchKeterangan').val();
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var query = $('#searchKeterangan').val();
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query, fromDate, untilDate);
        });

        $(document).on('click', '#delDate', function(event) {
            event.preventDefault();
            $('#fromDate').val("{!!now()->subYear()->format('d-m-Y')!!}");
            $('#untilDate').val("{!!now()->format('d-m-Y')!!}");
            var query = $('#searchKeterangan').val();
            var page = "{{url()->current()}}".split('page=')[1];
            $('#hidden_page').val(page);
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        });

        $(document).on('click', '#searchDate', function(event) {
            event.preventDefault();
            var query = $('#searchKeterangan').val();
            var page = "{{url()->current()}}".split('page=')[1];
            $('#hidden_page').val(page);
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        });

        $(document).on('click', '#delSearch', function(event) {
            event.preventDefault();
            $('#searchKeterangan').val('');
            var query = $('#searchKeterangan').val();
            var page = "{{url()->current()}}".split('page=')[1];
            $('#hidden_page').val(page);
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        });

        $(document).on('changeDate', '#fromDate', function(event) {
            event.preventDefault();
            $(this).datepicker('hide');
            var query = $('#searchKeterangan').val();
            var page = "{{url()->current()}}".split('page=')[1];
            $('#hidden_page').val(page);
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        })

        $(document).on('changeDate', '#untilDate', function(event) {
            event.preventDefault();
            $(this).datepicker('hide');
            var query = $('#searchKeterangan').val();
            var page = "{{url()->current()}}".split('page=')[1];
            $('#hidden_page').val(page);
            var fromDate = $('#fromDate').val();
            var untilDate = $('#untilDate').val();
            fetch_data(page, query, fromDate, untilDate);
        })
    });

    $(function() {
        $('.input-daterange #fromDate').each(function() {
            $(this).datepicker({
                clearDates: true,
                language: "id",
                format: 'dd-mm-yyyy',
                autoclose: true,
                orientation: "left bottom"
            }).on('changeDate', function() {
                $(this).datepicker('hide');
            });
        });
        $('.input-daterange #untilDate').each(function() {
            $(this).datepicker({
                clearDates: true,
                language: "id",
                format: 'dd-mm-yyyy',
                autoclose: true,
                orientation: "right bottom"
            }).on('changeDate', function() {
                $(this).datepicker('hide');
            });
        });
    });
</script>
@endsection