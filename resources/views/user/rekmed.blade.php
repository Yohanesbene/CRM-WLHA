<x-app-layout>
    {{-- ADMIN DASHBOARD <br>
    YANG LOGIN SIAPA ? <br>
    -------------------------------------------------------------------------------------------------<br>
    {{ Session::get('auth_wlha')->pluck('id')[0] }} <br>
    -------------------------------------------------------------------------------------------------<br>

    <button type="button"><a  href="{{route('pegawai.tambah')}}">Tambah Pegawai</a></button>
    <button type="button"><a  href="{{route('pegawai.ubahpassword')}}">Ubah Password</a></button>
    <button type="button"><a  href="{{route('auth.logout')}}">Logout</a></button>
    <div>
        @if (Session::has('message_success'))
            @for ($i = 0; $i < count(Session::get('message_success')); $i++)
            {{ Session::get('message_success')[$i] }}
            @endfor
        @endif
    </div> --}}
    {{-- @section('contents') --}}
    <div class="flex-auto bg-indigo-50 py-6 px-10">
        <div class="block p-8 bg-white rounded-md">
            <!-- START: Data Table -->
            <div class="flex flex-col mt-8">
                <div class="m-3">
                    <input type="text" name="searchPenghuni" id="searchPenghuni"
                        class="border border-indigo-200 rounded-lg p-3 text-lg" placeholder="Cari Data"
                        <?php
                        if (isset($query)):
                            echo 'value=' . "'" . $query . "'";
                        endif;
                        ?> />
                </div>
                <div class="overflow-x-auto" id="data-result">
                    @include('user/rekmed_daftar_penghuni')
                </div>
            </div>
            <!-- END: Data Table -->
        </div>
    </div>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var timer;

            function clear_icon() {
                $('#id_icon').html('');
                $('#post_title_icon').html('');
            }

            function fetch_data(page, query) {
                $.ajax({
                    url: "medicalrecord/fetch_data?query=" + query + "&page=" + page,
                    type: 'GET',
                    success: function(data) {
                        $('#data-result').html('');
                        $('#data-result').html(data);
                    }
                })
            }

            var timer;

            $(document).on('click', '.paginator', function(event) {
                event.preventDefault();
                var query = $(this).attr("href");
                fetch_data(query);
            });

            $(document).on('keyup', '#searchPenghuni', function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    var query = $('#searchPenghuni').val();
                    var page = 1;
                    fetch_data(page, query);
                }, 700);
            });
        });
    </script>
    {{-- @endsection --}}



</x-app-layout>
