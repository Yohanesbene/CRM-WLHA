<x-app-user-layout>
    <script src="/js/chartjs/dist/chart.js"></script>

    {{-- @section('contents') --}}
    <div class="flex flex-col bg-indigo-50 py-6 px-10">

        {{-- START: data penghuni --}}
        <div class="block flex-col p-8 bg-white rounded-md">
            <div class="flex flex-col lg:flex-row gap-3">
                <div>
                    <div class="w-48 h-48 bg-gray-200">

                    </div>
                </div>
                <div class="leading-loose">
                    <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
                    <p>Kode Ruang : {{ $penghuni->ruang }}</p>
                </div>
            </div>
            <div class="flex mt-4 text justify-end gap-4">
                <a href="{{ route('user.detail_medis', ['id' => $penghuni->id]) }}">
                    <button class="p-3 rounded-md bg-indigo-200 hover:bg-indigo-600 hover:text-gray-50">
                        Kembali
                    </button>
                </a>
                <a href="{{ route('user.mcu.tambah', ['id' => $penghuni->id]) }}">
                    <button class="p-3 rounded-md bg-indigo-200 hover:bg-indigo-600 hover:text-gray-50">
                        Input Rekam Medis
                    </button>
                </a>
            </div>
        </div>
        {{-- END: data penghuni --}}
        @if (Session::has('message'))
            <div class="py-3 px-5 mb-4 bg-green-100 text-green-900 text-sm rounded-md border border-green-200 transition-opacity"
                role="alert" id="message">
                <ul>
                    <li>{{ Session::get('message') }} <span class="float-right"><a
                                id="dismiss-message" href="#">x</a></span></li>
                </ul>
            </div>
        @endif
        @if ($key != 'pemberian_obat')
            <div class="flex-col p-8 bg-white rounded-md mt-4 hidden md:block" id="data-chart">
                @include('user/detail_medis_chart')
            </div>
        @endif
        <div class="block p-8 col-span-2 lg:col-auto bg-white rounded-md h-auto mt-4" id="data-table">
            @include('user/detail_medis_table')
        </div>
    </div>
    <script>
        $("#dismiss-message").click(function() {
            $("#message").addClass('hidden duration-100');
        });
    </script>
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

            function fetch_data(query) {
                var url = "{{ url('/') }}" + query;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#data-table').html('');
                        $('#data-table').html(data);
                    }
                })
            }

            function fetch_chart(fromDate, untilDate) {
                var url = "{{ url('/') }}" + "/user/detail_medis_chart/" + "{{ $penghuni->id }}" + '/' + "{{ $key }}" + '/' + fromDate + "/" + untilDate;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#data-chart').html('');
                        $('#data-chart').html(data);
                    }
                })
                console.log(url);
            }

            $(document).on('click', '.paginator', function(event) {
                event.preventDefault();
                var query = $(this).attr("href");
                fetch_data(query);
            });

            $(document).on('change', '#fromDate', function(event) {

                console.log("changed");
                event.preventDefault();
                var fromDate = $('#fromDate').val();
                var untilDate = $('#untilDate').val();
                fetch_chart(fromDate, untilDate);
            })

            $(document).on('change', '#untilDate', function(event) {
                console.log("changed");
                event.preventDefault();
                var fromDate = $('#fromDate').val();
                var untilDate = $('#untilDate').val();
                console.log(fromDate);
                fetch_chart(fromDate, untilDate);
            })
        });
    </script>
    {{-- @endsection --}}
</x-app-user-layout>
