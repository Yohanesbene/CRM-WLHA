<x-app-layout>
    <div class="flex h-screen w-full" x-data="{ modalAddPenghuni: false, modalDetailUser: false, modalEditPenghuni: false, modalGantiPassword: false }" :class="{ 'overflow-y-hidden': modalAddPenghuni || modalDetailUser || modalEditPenghuni || modalGantiPassword }">
        <div class="flex-auto bg-indigo-50 py-6 px-10">
            <!-- START: List Mobilitas -->
            <div class="block p-8 bg-white rounded-md">
                <h2 class="text-3xl font-semibold text-black-400 leading-tight">Daftar Mobilitas</h2>
                <!-- START: Data Table -->
                <div class="flex flex-col mt-8">
                    <div class="overflow-x-auto">
                        <div class="align-middle inline-block min-w-full shadow-md overflow-hidden border-b border-gray-200 rounded-lg">
                            <table id="table-data" class="min-w-full display cell-border">
                                <thead class="bg-gray-50">
                                    <tr class="text-black uppercase text-base leading-normal">
                                        <th class="text-left py-3 px-6 font-semibold">ID</th>
                                        <th class="text-left py-3 px-6 font-semibold">No Induk</th>
                                        <th class="text-left py-3 px-6 font-semibold">Nama</th>
                                        <th class="text-left py-3 px-6 font-semibold">Tujuan</th>
                                        <th class="text-left py-3 px-6 font-semibold">Waktu Keberangkatan</th>
                                        <th class="text-left py-3 px-6 font-semibold">Waktu Kepulangan</th>
                                        <th class="text-left py-3 px-6 font-semibold">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                "processing": true,
                "serverSide": true,
                order: [
                    [4, 'desc']
                ],
                dom: 'Qfr<"ml-3"B>t<"mx-3"l>p',
                responsive: true,
                buttons: [{
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }

                }],
                "ajax": {
                    "url": "{{ route('mobilitas.data') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                columnDefs: [{
                    orderable: false,
                    targets: 6
                }],
                "columns": [{
                        'data': 'id'
                    },
                    {
                        'data': 'no_induk'
                    },
                    {
                        'data': 'nama'
                    },
                    {
                        'data': 'tujuan'
                    },
                    {
                        'data': 'keluar'
                    },
                    {
                        'data': 'kembali'
                    },
                    {
                        'data': 'action'
                    }
                ],
            });
        });
    </script>
</x-app-layout>
