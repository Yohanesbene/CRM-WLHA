<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{

    public function __construct()
    {
        $this->User = new User();
        $this->Penghuni = new Penghuni();
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
            'pemberian_obat' => ''
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

        if(empty($request->input('search.value')))
        {
            $penghuni = $this->Penghuni->daftar_penghuni('', $start, $limit, $order, $dir);
        }
        else
        {
            $search = $request->input('search.value');
            $penghuni = $this->Penghuni->daftar_penghuni($search, $start, $limit, $order, $dir);
        }
        $data = array();

        foreach ($penghuni as $key => $p) {
            $row['id'] = $start+$key+1;
            $row['nama'] = $p->nama;
            $row['ruang'] = $p->ruang;
            $row['status'] = $p->meninggal == 0 || $p->keluar == 0 ?
                    '<span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm">Active</span>' :
                    '<span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm">Inactive</span>';
            $row['action'] =
                    '<a href="'. route('rekmed.detail', ['id' => $p->id]) .'" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg> <p class="pl-3">Rekam Medis</p>
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

        foreach (['nadi', 'spo2', 'suhu_badan', 'berat_badan'] as $tb) {
            $data['data'][$tb] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->limit(10)
                ->get();
        };

        $data['data']['pemberian_obat'] = DB::table('mcu_' . 'pemberian_obat')
            ->join('tb_obat', 'mcu_pemberian_obat.id_obat', '=', 'tb_obat.id')
            ->select('mcu_pemberian_obat.*', 'tb_obat.namaobat')
            ->where('id_penghuni', $id)
            ->where('deleted', 0)
            ->orderBy('waktu', 'desc')
            ->limit(10)
            ->get();

        $data['satuan'] = $this->satuan;

        $data['data_2']['tekanan_darah'] = DB::table('mcu_tekanan_darah')
            ->where('id_penghuni', $id)
            ->orderBy('waktu', 'desc')
            ->limit(10)
            ->get();

        foreach (['nutrisi', 'cairan', 'urine', 'bab'] as $tb) {
            $data['data_3'][$tb] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
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
        if ($tb == 'pemberian_obat') {
            $data['data'] = DB::table('mcu_' . 'pemberian_obat')
                ->join('tb_obat', 'mcu_pemberian_obat.id_obat', '=', 'tb_obat.id')
                ->select('mcu_pemberian_obat.*', 'tb_obat.namaobat')
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->paginate(10);
        } else {
            $data['data'] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->paginate(10);
        };
        $data['data']->key = $tb;
        $date_prev = now()->subDays(30);
        $date_next = now();
        $data['date'] = [$date_prev, $date_next];

        if (in_array($tb, ['nutrisi', 'cairan'])) {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->select(DB::raw('id, id_penghuni, id_pegawai, waktu, COALESCE (pagi, siang, sore) AS hasil'))
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'desc')
                ->get();
        } else {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'desc')
                ->get();
        }
        $data['key'] = $tb;
        $data['satuan'] = $this->satuan;

        return view('rekammedis.detail_medis_data', $data);
    }

    public function detail_medis_table(Request $request, $id, $tb)
    {
        $data['page_url'] = '/user/detail_medis_table/' . $id . '/' . $tb;

        $data['penghuni'] = Penghuni::detail_penghuni($id);
        if ($tb == 'pemberian_obat') {
            $data['data'] = DB::table('mcu_' . 'pemberian_obat')
                ->join('tb_obat', 'mcu_pemberian_obat.id_obat', '=', 'tb_obat.id')
                ->select('mcu_pemberian_obat.*', 'tb_obat.namaobat')
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->paginate(10);
        } else {
            $data['data'] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->paginate(10);
        }
        $data['data']->key = $tb;
        $data['key'] = $tb;
        $data['satuan'] = $this->satuan;

        return view('rekammedis.detail_medis_table', $data)->render();
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
                ->where('deleted', 0)
                ->whereBetween('waktu', [$date_prev, $date_next->copy()->addDays(1)])
                ->orderBy('waktu', 'asc')
                ->get();
        } else {
            $data['chart'] = DB::table('mcu_' . $tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
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

        return view('rekammedis.tambah_mcu', $data);
    }


    public function hapus_mcu($id, $data, $id_penghuni)
    {
        DB::table('mcu_' . $data)
            ->where('id', $id)
            ->update(['deleted' => 1]);
        return redirect(url()->previous())->with('message', 'data berhasil dihapus');
    }

    public function simpan_mcu(Request $request)
    {
        $input = $request->input();
        // dd($input);
        if ($input['id_penghuni']) {
            foreach (['berat_badan', 'nadi', 'spo2', 'suhu_badan'] as $tb) {
                if ($input[$tb]) {
                    DB::table('mcu_' . $tb)->insert([
                        'id_pegawai' => $input['id_pegawai'],
                        'id_penghuni' => $input['id_penghuni'],
                        'hasil' => $input[$tb],
                        'waktu' => now()
                    ]);
                }
            }


            foreach (['nutrisi', 'cairan', 'urine', 'bab'] as $tb) {
                foreach (['pagi', 'siang', 'sore'] as $waktu) {
                    if ($input[$tb . "_" . $waktu]) {
                        DB::table("mcu_" . $tb)->insert([
                            'id_pegawai' => $input['id_pegawai'],
                            'id_penghuni' => $input['id_penghuni'],
                            $waktu => $input[$tb . "_" . $waktu],
                            'waktu' => now()
                        ]);
                    }
                }
            }

            if ($input['systole'] && $input['diastole']) {
                DB::table('mcu_tekanan_darah')->insert([
                    'id_pegawai' => $input['id_pegawai'],
                    'id_penghuni' => $input['id_penghuni'],
                    'sistole' => $input['systole'],
                    'diastole' => $input['diastole'],
                    'waktu' => now()
                ]);
            }
        }

        return redirect(route('rekmed.detail', ['id' => $input['id_penghuni']]))->with('message', 'data berhasil ditambahkan');
    }
}
