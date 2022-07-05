{{-- <div class="flex mb-4 justify-between w-full">
    <p class="text-2xl font-bold mb-3">{{ ucwords(str_replace('_', ' ', $key)) }} ( {!! $satuan[$key] !!} )</p>
    <div>Search : <input
            type="text" name="search" id="search"
            class="z-10 border border-indigo-200 rounded-lg p-3 text-lg">
    </div>
</div> --}}
<div class="mt-8 flex flex-col">
  <div>
    @if (Session::has('message_success'))
      @for ($i = 0; $i < count(Session::get('message_success')); $i++)
        <div class="mb-4 rounded-md border border-red-200 bg-green-100 py-3 px-5 text-sm text-green-900"
          role="alert">
          {{ Session::get('message_success')[$i] }}
        </div>
      @endfor
    @endif
  </div>
  <div class="overflow-x-auto">
    <div class="inline-block min-w-full overflow-hidden border-b border-gray-200 align-middle shadow-md">
      <table id="table-data" class="display cell-border min-w-full" width="100%">
        <thead class="bg-gray-50">
          <tr class="text-base uppercase leading-normal text-black">
            <th class="py-3 px-6 text-left font-semibold">ID Pegawai</th>
            <th class="py-3 px-6 text-left font-semibold">Sistole</th>
            <th class="py-3 px-6 text-left font-semibold">Diastole</th>
            <th class="py-3 px-6 text-left font-semibold">Waktu</th>
            <th class="py-3 px-6 text-left font-semibold">Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    const dt_table = $('#table-data').DataTable({
      "processing": true,
      "serverSide": true,
      dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
      responsive: true,
      buttons: [{
        extend: 'print',
        exportOptions: {
          columns: [0, 1, 2, 3, 4]
        }
      }],
      columnDefs: [{
          orderable: false,
          targets: 4
        },
        {
          "searchable": false,
          "targets": 3
        }
      ],
      "pageLength": 7,
      "lengthMenu": [7, 15, 20, 25],
      "ajax": {
        "url": "{{ route('rekmed.data_details_table', [$key]) }}",
        "dataType": "json",
        "type": "POST",
        "data": function(dtParams) {
          dtParams._token = "{{ csrf_token() }}";
          dtParams.id_penghuni = "{{ $penghuni->id }}";
          dtParams.startDate = $('#fromDate').val();
          dtParams.endDate = $('#untilDate').val();
          return dtParams
        }
      },
      "columns": [{
          'data': 'id_pegawai'
        },
        {
          'data': 'sistole'
        },
        {
          'data': 'diastole'
        },
        {
          'data': 'waktu'
        },
        {
          'data': 'action'
        }
      ],
    });

    function draw_table(startDate = "", endDate = "") {
      dt_table.ajax = {
        "url": "{{ route('rekmed.data_details_table', [$key]) }}",
        "dataType": "json",
        "type": "POST",
        "data": {
          _token: "{{ csrf_token() }}",
          id_penghuni: "{{ $penghuni->id }}",
          startDate: startDate,
          endDate: endDate
        },
      }

      dt_table.draw();
    };

    draw_table();
    $(document).on('change', '#fromDate', function(event) {
      event.preventDefault();
      var fromDate = $('#fromDate').val();
      var untilDate = $('#untilDate').val();
      draw_table(fromDate, untilDate);
    })

    $(document).on('change', '#untilDate', function(event) {
      event.preventDefault();
      var fromDate = $('#fromDate').val();
      var untilDate = $('#untilDate').val();
      draw_table(fromDate, untilDate);
    });
  })
</script>
