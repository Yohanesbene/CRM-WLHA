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
            $.ajax({
                url: "/transaksi_obat/fetch_data?query=" + query + "&from=" + fromDate + "&until=" + untilDate + "&page=" + page,
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