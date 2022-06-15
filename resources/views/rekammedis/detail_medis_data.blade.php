<x-app-layout>
  <script src="/js/chartjs/dist/chart.js"></script>

  {{-- @section('contents') --}}
  <div class="flex-auto bg-indigo-50 py-6 px-10">

    {{-- START: data penghuni --}}
    <div class="block flex-col rounded-md bg-white p-8">
      <div class="flex flex-col gap-3 lg:flex-row">
        <div>
          <div class="h-48 w-48 bg-gray-200">
          </div>
        </div>
        <div class="leading-loose">
          <p class="text-2xl font-bold">{{ $penghuni->nama }}</p>
          <p>Kode Ruang : {{ $penghuni->ruang }}</p>
        </div>
      </div>
      <div class="text mt-4 flex justify-end gap-4">
        <a href="{{ route('rekmed.detail', ['id' => $penghuni->id]) }}">
          <button class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50">
            Kembali
          </button>
        </a>
        <a href="{{ route('rekmed.tambah', ['id' => $penghuni->id, 'bagian' => $key]) }}">
          <button class="rounded-md bg-indigo-200 p-3 hover:bg-indigo-600 hover:text-gray-50">
            Input Rekam Medis
          </button>
        </a>
      </div>
    </div>
    {{-- END: data penghuni --}}

    @if (Session::has('message'))
      <div class="mb-4 rounded-md border border-green-200 bg-green-100 py-3 px-5 text-sm text-green-900 transition-opacity"
        role="alert" id="message">
        <ul>
          <li>{{ Session::get('message') }} <span class="float-right"><a
                id="dismiss-message" href="#">x</a></span></li>
        </ul>
      </div>
    @endif
    @if ($key != 'pemberian_obat')
      <div class="mt-4 hidden flex-col rounded-md bg-white p-8 md:block" id="data-chart">
        @include('rekammedis/detail_medis_chart')
      </div>
    @endif
    <div class="mt-4 block rounded-md bg-white p-8">
      <p class="flex justify-center text-xl font-bold uppercase">{{ $key }} - {!! $satuan !!}</p>
      @include($table_view)
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
    });
  </script>
  {{-- @endsection --}}
</x-app-layout>
