<x-app-layout>
  {{-- ADMIN DASHBOARD <br>
    YANG LOGIN SIAPA ? <br>
    -------------------------------------------------------------------------------------------------<br>
    {{ Session::get('auth_wlha')->pluck('id')[0] }} <br>
    -------------------------------------------------------------------------------------------------<br>

    <button type="button"><a href="{{route('penghuni.tambah')}}">Tambah Penghuni</a></button>
    <button type="button"><a href="{{route('penghuni.edit')}}">Ubah Penghuni</a></button>
    <!-- <button type="button"><a href="{{route('auth.logout')}}">Logout</a></button> -->
    <div>
        @if (Session::has('message_success'))
        @for ($i = 0; $i < count(Session::get('message_success')); $i++) {{ Session::get('message_success')[$i] }} @endfor @endif </div> --}}
  <div class="flex h-screen w-full">
    <div class="flex-auto bg-indigo-50 py-6 px-10">
      <!-- START: List Penghuni -->
      <div class="block p-8 bg-white rounded-md">
        <!-- START: Heading -->
        <h2 class="text-3xl font-semibold text-black-400 leading-tight">Daftar Penghuni</h2>
        <!-- START: Data Table -->
        <div class="flex flex-col mt-8">
          <div class="overflow-x-auto">
            <div class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
              <table id="table-data" class="min-w-full display cell-border">
                <thead class="bg-gray-50">
                  <tr class="text-black uppercase text-base leading-normal">
                    <th class="text-left py-3 px-6 font-semibold">ID</th>
                    <th class="text-left py-3 px-6 font-semibold">Nama</th>
                    <th class="text-left py-3 px-6 font-semibold">Ruang</th>
                    <th class="text-left py-3 px-6 font-semibold">Status</th>
                    <th class="text-left py-3 px-6 font-semibold">Action</th>
                  </tr>
                </thead>
                {{-- <tbody class="text-gray-700 text-base font-light bg-white">
                                    @foreach ($user as $u)
                                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-medium">{{ $u->no_induk }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ $u->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="font-semibold">{{ $u->ruang }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($u->meninggal == 0 || $u->keluar == 0)
                                                        <span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm">Active</span>
                                                    @else
                                                        <span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm">Inactive</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="flex py-3 px-6">
                                                <div class="flex items-center space-x-4">
                                                    <a href="{{ route('rekmed.detail', ['id' => $u->id]) }}" class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                        </svg> Asuhan Keperawatan
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- END:List Penghuni -->
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#table-data').DataTable({
        "processing": true,
        "serverSide": true,
        dom: '<"flex"B><"flex items-center gap-4"l<"ml-auto"f>>tp',
        responsive: true,
        "ajax": {
          "url": "{{ route('askep.data') }}",
          "dataType": "json",
          "type": "POST",
          "data": {
            _token: "{{ csrf_token() }}"
          }
        },
        columnDefs: [{
          orderable: false,
          targets: 4
        }],
        "columns": [{
            'data': 'id'
          },
          {
            'data': 'nama'
          },
          {
            'data': 'ruang'
          },
          {
            'data': 'status'
          },
          {
            'data': 'action'
          }
        ],
      });
    })
  </script>
</x-app-layout>