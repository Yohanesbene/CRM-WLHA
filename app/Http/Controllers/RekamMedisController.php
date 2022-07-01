<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penghuni;
use App\Models\RekamMedis;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RekamMedisController extends Controller
{

    public function __construct()
    {
        $this->User = new User();
        $this->Penghuni = new Penghuni();
        $this->RekamMedis = new RekamMedis();
        $this->satuan = [
            'nadi' => ' bpm',
            'spo2' => ' %',
            'suhu_badan' => ' &deg;C',
            'berat_badan' => ' kg',
            'nutrisi' => ' Porsi',
            'cairan' => ' ml',
            'urine' => '',
            'bab' => '',
            'tekanan_darah' => ' mmHg',
            'pemberian_obat' => '',
            'kolesterol' => '',
            'asam_urat' => '',
            'gds' => ''
        ];

        $this->table_name = [
            'nadi' => 'mcu_nadi',
            'spo2' => 'mcu_spo2',
            'suhu_badan' => 'mcu_suhu_badan',
            'berat_badan' => 'mcu_berat_badan',
            'nutrisi' => 'mcu_nutrisi',
            'cairan' => 'mcu_cairan',
            'urine' => 'mcu_urine',
            'bab' => 'mcu_bab',
            'tekanan_darah' => 'mcu_tekanan_darah',
            'pemberian_obat' => 'mcu_pemberian_obat',
            'kolesterol' => 'mcu_kolesterol',
            'asam_urat' => 'mcu_asam_urat',
            'gds' => 'mcu_gds'
        ];

        $this->columns = [
            'nadi' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action',
            ),
            'spo2' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action',
            ),
            'suhu_badan' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action',
            ),
            'berat_badan' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action',
            ),
            'nutrisi' => array(
                0 => 'id_pegawai',
                1 => 'pagi',
                2 => 'siang',
                3 => 'sore',
                4 => 'waktu',
                5 => 'action',
            ),
            'cairan' => array(
                0 => 'id_pegawai',
                1 => 'pagi',
                2 => 'siang',
                3 => 'sore',
                4 => 'waktu',
                5 => 'action',
            ),
            'urine' => array(
                0 => 'id_pegawai',
                1 => 'pagi',
                2 => 'siang',
                3 => 'sore',
                4 => 'waktu',
                5 => 'action',
            ),
            'bab' => array(
                0 => 'id_pegawai',
                1 => 'pagi',
                2 => 'siang',
                3 => 'sore',
                4 => 'waktu',
                5 => 'action',
            ),
            'tekanan_darah' => array(
                0 => 'id_pegawai',
                1 => 'sistole',
                2 => 'diastole',
                3 => 'waktu',
                4 => 'action',
            ),
            'pemberian_obat' => array(
                0 => 'id_pegawai',
                1 => 'dosis',
                2 => 'waktu',
                3 => 'action',
            ),
            'kolesterol' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action'
            ),
            'asam_urat' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action',
            ),
            'gds' => array(
                0 => 'id_pegawai',
                1 => 'hasil',
                2 => 'waktu',
                3 => 'action',
            )
        ];
    }

    public function penghuni()
    {
        // $data['user'] = $this->Penghuni->daftar_penghuni();
        return view('rekammedis.index');
    }

    public function data_penghuni(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'nama',
            2 => 'tgl_lahir',
            3 => 'ruang',
            4 => 'status',
            5 => 'action'
        );

        $totalData = Penghuni::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $penghuni = $this->Penghuni->daftar_penghuni('', $start, $limit, $order, $dir);
        } else {
            $search = $request->input('search.value');
            $penghuni = $this->Penghuni->daftar_penghuni($search, $start, $limit, $order, $dir);
        }
        $data = array();

        foreach ($penghuni as $key => $p) {
            $row['id'] = $start + $key + 1;
            $row['nama'] = $p->nama;
            $row['ruang'] = $p->ruang;
            $row['status'] = $p->meninggal == 0 || $p->keluar == 0 ?
                '<span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm">Active</span>' :
                '<span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm">Inactive</span>';
            $row['action'] =
                '<a href="' . route('rekmed.detail', ['id' => $p->id]) . '" class="flex w-fit items-center text-indigo-400 font-medium text-lg border-transparent border-b-2 hover:border-indigo-900 pb-1 hover:text-indigo-900 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg> <p class="pl-3">Rekam Medis</p>
                </a>
                <a href="' . route('rekmed.tambah', ['id' => $p->id, 'bagian' => 'all']) . '" class="flex w-fit items-center text-indigo-400 font-medium text-lg border-transparent border-b-2 hover:border-indigo-900 pb-1 hover:text-indigo-900 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
</svg>
                    <p class="pl-3">Input Rekam Medis</p>
                </a>';
            $data[] = $row;
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function detailMedis($id)
    {
        $data['penghuni'] = $this->Penghuni->detail_penghuni($id);

        foreach (['nadi', 'spo2', 'suhu_badan', 'berat_badan', 'gds', 'kolesterol', 'asam_urat'] as $tb) {
            $data['data'][$tb] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('mcu_' . $tb . '.deleted', 0)
                ->orderBy('waktu', 'desc')
                ->limit(10)
                ->get();
        };

        $data['data']['pemberian_obat'] = DB::table('mcu_' . 'pemberian_obat')
            ->join('tb_obat', 'mcu_pemberian_obat.id_obat', '=', 'tb_obat.id')
            ->select('mcu_pemberian_obat.*', 'tb_obat.namaobat')
            ->where('id_penghuni', $id)
            ->where('mcu_pemberian_obat.deleted', 0)
            ->orderBy('waktu', 'desc')
            ->limit(10)
            ->get();

        $data['satuan'] = $this->satuan;

        $data['data_2']['tekanan_darah'] = DB::table('mcu_tekanan_darah')
            ->where('id_penghuni', $id)
            ->where('mcu_tekanan_darah.deleted', 0)
            ->orderBy('waktu', 'desc')
            ->limit(10)
            ->get();

        foreach (['nutrisi', 'cairan', 'urine', 'bab'] as $tb) {
            $data['data_3'][$tb] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('mcu_' . $tb . '.deleted', 0)
                ->orderBy('waktu', 'desc')
                ->limit(10)
                ->get();
        }
        return view('rekammedis.detail_medis', $data);
    }

    public function detail_medis_data($id, $tb)
    {
        $data['page_url'] = '/user/detail_medis_table/' . $id . '/' . $tb;

        $data['penghuni'] = Penghuni::detail_penghuni($id);

        $date_prev = now()->subDays(30);
        $date_next = now();
        $data['date'] = [$date_prev, $date_next];

        if (in_array($tb, ['nutrisi', 'cairan', 'bab', 'urine'])) {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->select(DB::raw('id, id_penghuni, id_pegawai, waktu, COALESCE (pagi, siang, sore) AS hasil'))
                ->where('id_penghuni', $id)
                ->where('mcu_' . $tb . '.deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'asc')
                ->get();
        } else {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('mcu_' . $tb . '.deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'asc')
                ->get();
        }
        $data['key'] = $tb;
        $data['satuan'] = $this->satuan[$tb];
        $table_name = $this->table_name[$tb];

        if ($table_name == 'mcu_pemberian_obat') {
            $data['table_view'] = 'rekammedis.detail_medis_table_pemberian_obat';
        } else if ($table_name == 'mcu_tekanan_darah') {
            $data['table_view'] = 'rekammedis.detail_medis_table_tekanan_darah';
        } else if (in_array($table_name, ['mcu_nutrisi', 'mcu_urine', 'mcu_bab', 'mcu_cairan'])) {
            $data['table_view'] = 'rekammedis.detail_medis_table_pagi_siang_sore';
        } else {
            $data['table_view'] = 'rekammedis.detail_medis_table';
        }

        return view('rekammedis.detail_medis_data', $data);
    }

    public function detail_medis_table(Request $request, $tb)
    {
        $columns = $this->columns[$tb];

        $id_penghuni = $request->input('id_penghuni');
        $table_name = $this->table_name[$tb];

        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = empty($request->input('search.value')) ? '' : $request->input('search.value');
        $startDate = empty($request->input('startDate')) ? '' : $request->input('startDate');
        $endDate = empty($request->input('endDate')) ? '' : $request->input('endDate');

        $db_data = $this->RekamMedis->get_detail_medis_data($table_name, $id_penghuni, $search, $start, $limit, $order, $dir, $startDate, $endDate);
        $totalData = $this->RekamMedis->count_detail_medis_data($table_name, $id_penghuni, $search, $startDate, $endDate);

        $totalFiltered = $totalData;
        $data = array();

        foreach ($db_data as $key => $p) {
            // $penghuni = $this->Penghuni->detail_penghuni($p->id_penghuni);
            $row['id_pegawai'] = $p->id_pegawai;
            if ($table_name == 'mcu_pemberian_obat') {
                $row['dosis'] =  $p->namaobat . '<br>' . $p->dosis . ' dosis';
            } else if ($table_name == 'mcu_tekanan_darah') {
                $row['sistole'] = $p->sistole;
                $row['diastole'] = $p->diastole;
            } else if (in_array($table_name, ['mcu_nutrisi', 'mcu_urine', 'mcu_bab', 'mcu_cairan'])) {
                $row['pagi'] = $p->pagi;
                $row['siang'] = $p->siang;
                $row['sore'] = $p->sore;
            } else {
                $row['hasil'] = $p->hasil;
            }
            $row['waktu'] = Carbon::parse($p->waktu)->format('d M Y - h:i');
            $row['action'] = '';
            $data[] = $row;
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function detail_medis_chart($id, $tb, $date_prev = '', $date_next = '')
    {
        $data['penghuni'] = Penghuni::detail_penghuni($id);
        $date_prev == '' ? $date_prev = Carbon::now()->subDays(30) : $date_prev = Carbon::parse($date_prev);
        $date_next == '' ? $date_next = Carbon::now() : $date_next = Carbon::parse($date_next);

        if ($date_prev > $date_next) {
            $bin = clone ($date_prev);
            $date_prev = clone ($date_next);
            $date_next = clone ($bin);
        }

        if (in_array($tb, ['nutrisi', 'cairan'])) {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->select(DB::raw('id, id_penghuni, id_pegawai, waktu, COALESCE (pagi, siang, sore) AS hasil'))
                ->where('id_penghuni', $id)
                ->where('mcu_' . $tb . '.deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'asc')
                ->get();
        } else {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('mcu_' . $tb . '.deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'asc')
                ->get();
        }
        $data['date'] = [$date_prev, $date_next];
        $data['key'] = $tb;
        $data['satuan'] = [
            'nadi' => ' bpm',
            'spo2' => ' %',
            'suhu_badan' => ' &deg;C',
            'berat_badan' => ' kg',
            'nutrisi' => ' Porsi',
            'cairan' => ' ml',
            'urine' => '',
            'bab' => '',
            'tekanan_darah' => ' mmHg'
        ];

        return view('rekammedis.detail_medis_chart', $data)->render();
    }

    public function tambah_mcu($bagian = 'all', $id)
    {
        $data['penghuni'] = $this->Penghuni->detail_penghuni($id);
        $data['bagian'] = $bagian;

        if ($bagian == 'pemberian_obat' || $bagian == 'all') {
            $data['daftar_obat'] = Obat::daftar_obat_all();
        } else {
            $data['daftar_obat'] = [];
        }

        return view('rekammedis.tambah_mcu', $data);
    }


    public function hapus_mcu(Request $request)
    {
        $table = $request->input('table');
        $id = $request->input('id');
        $id_penghuni = $request->input('id_penghuni');

        DB::table('mcu_' . $table)
            ->where('id', $id)
            ->update(['deleted' => 1]);
        return redirect(url()->previous())->with('message', 'data berhasil dihapus');
    }

    public function simpan_mcu(Request $request)
    {
        $input = $request->input();
        $message = '';

        if ($input['id_penghuni']) {
            foreach (['nadi', 'spo2', 'suhu_badan', 'berat_badan', 'gds', 'kolesterol', 'asam_urat'] as $tb) {
                if (isset($input[$tb])) {
                    DB::table('mcu_' . $tb)->insert([
                        'id_pegawai' => $input['id_pegawai'],
                        'id_penghuni' => $input['id_penghuni'],
                        'hasil' => $input[$tb],
                        'waktu' => now()
                    ]);
                    $message .= ucwords(str_replace('_', ' ', $tb));
                    $message .= "<br>";
                }
            }


            foreach (['nutrisi', 'cairan', 'urine', 'bab'] as $tb) {
                foreach (['pagi', 'siang', 'sore'] as $waktu) {
                    if (isset($input[$tb . "_" . $waktu])) {
                        DB::table("mcu_" . $tb)->insert([
                            'id_pegawai' => $input['id_pegawai'],
                            'id_penghuni' => $input['id_penghuni'],
                            $waktu => $input[$tb . "_" . $waktu],
                            'waktu' => now()
                        ]);
                        $message .= ucwords(str_replace('_', ' ', $tb));
                        $message .= " " . $waktu;
                        $message .= "<br>";
                    }
                }
            }

            if (isset($input['systole']) && isset($input['diastole'])) {
                DB::table('mcu_tekanan_darah')->insert([
                    'id_pegawai' => $input['id_pegawai'],
                    'id_penghuni' => $input['id_penghuni'],
                    'sistole' => $input['systole'],
                    'diastole' => $input['diastole'],
                    'waktu' => now()
                ]);
                $message .= ucwords('tekanan darah');
                $message .= "<br>";
            }

            if (isset($input['id_obat']) && isset($input['dosis'])) {
                DB::table('mcu_pemberian_obat')->insert([
                    'id_pegawai' => $input['id_pegawai'],
                    'id_penghuni' => $input['id_penghuni'],
                    'id_obat' => $input['id_obat'],
                    'dosis' => $input['dosis'],
                    'waktu' => now()
                ]);
                $message .= ucwords('pemberian obat');
                $message .= "<br>";
            }
        }
        if ($message != '') {
            return redirect(route('rekmed.detail', ['id' => $input['id_penghuni']]))->with('message', 'Rekam medis <br><strong class="block pl-2">' . $message . "</strong>berhasil ditambahkan");
        } else {
            return redirect(route('rekmed.detail', ['id' => $input['id_penghuni']]));
        }
    }
}
