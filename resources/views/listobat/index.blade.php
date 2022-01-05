@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col mt-5">
            <h1 class="text-center fs-1">
                Inventaris Obat
            </h1>
            <p class="fs-3 mt-4 max-w-3xl mx-auto text-center text-xl text-gray-500">
                Pengurangan, Penambahan, Pendataan obat baru, Penghapusan obat
            </p>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-1"></div>
        <div class="col-10">
            <a class="fs-3 btn btn-primary mt-1" href="{{url('/transaksi_obat')}}">Tampilkan Seluruh Daftar Transaksi</a>
        </div>
        <div class="col-1"></div>
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
    <div class="row my-3 fs-3">
        <div class="col-1"></div>

        <div class="col-10">
            <div class="form-group">
                <input type="text" name="searchObat" id="searchObat" class="form-control fs-3" placeholder="Cari Nama Obat" />
            </div>
        </div>
        <div class="col-1"></div>
    </div>

    <div class="row my-2 fs-3">
        <div class="col-1"></div>
        <div class="col-10" id="data-result">
            @include('listobat/obat_data')
        </div>
        <div class="col-1"></div>
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

        function fetch_data(page, query) {
            $.ajax({
                url: "/daftar_obat/fetch_data?query=" + query + "&page=" + page,
                type: 'GET',
                success: function(data) {
                    $('#data-result').html('');
                    $('#data-result').html(data);
                }
            })
        }

        $(document).on('keyup', '#searchObat', function() {
            var query = $('#searchObat').val();
            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();
            var page = 1;
            fetch_data(page, query);
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
            var query = $('#searchObat').val();
            fetch_data(page, query);
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            var column_name = $('#hidden_column_name').val();
            var sort_type = $('#hidden_sort_type').val();

            var query = $('#searchObat').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query);
        });
    });
</script>
@endsection