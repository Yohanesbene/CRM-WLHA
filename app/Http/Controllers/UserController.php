<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
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
        $this->Penghuni = new Penghuni();
    }

    public function rekamMedis(Request $request)
    {
        if ($query = $request->input('query')) {
            $query = $request->input('query');
            $data['query'] = $query;
            $data['page_url'] = '/user/rekammedis?query=' . $query;

            $query = str_replace(" ", "%", $query);

            $data['penghuni'] = Penghuni::daftar_penghuni($query);
        } else {
            $data['page_url'] = '/user/rekammedis';
            $data['penghuni'] = Penghuni::paginate(10);
        };
        return view('user.rekmed', $data);
    }

    public function fetch_data(Request $request)
    {
        $query = $request->input('query');
        $data['page_url'] = '/user/rekammedis?query=' . $query;
        $data['query'] = $query;

        $query = str_replace(" ", "%", $query);

        $data['penghuni'] = Penghuni::daftar_penghuni($query);

        $data['count'] = $data['penghuni']->count();

        return view('user.rekmed_daftar_penghuni', $data)->render();
    }

    public function detail_medis($id)
    {
        $data['penghuni'] = Penghuni::detail_penghuni($id);

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
        return view('user.detail_medis', $data);
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
        $data['key'] = $tb;
        $data['satuan'] = $this->satuan;

        return view('user.detail_medis_data', $data);
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

        return view('user.detail_medis_table', $data)->render();
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

        return view('user.detail_medis_chart', $data)->render();
    }

    public function tambah_mcu($id)
    {
        $data['penghuni'] = Penghuni::detail_penghuni($id);

        return view('user.tambah_mcu', $data);
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
        }

        return redirect(route('user.detail_medis', ['id' => $input['id_penghuni']]))->with('message', 'data berhasil ditambahkan');
    }

    public function hasil_rekam($data)
    {
        dd($data);
    }

    public function penghuni()
    {
        $data['user'] = $this->Penghuni->daftar_penghuni();
        return view('user.penghuni')->with($data);
    }

    public function tambahPenghuni()
    {
        return view('user.tambahpenghuni');
    }

    public function prosesTambahPenghuni(Request $request)
    {
        $message = [
            'required' => 'Harap isi :attribute',
            'same' => ':other tidak sesuai dengan :attribute',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute minimal :max karakter',
            'integer' => ':attribute hanya boleh karakter angka saja',
            'date' => ':attribute tidak valid',
            'nik.regex' => ':attribute hanya boleh angka saja',
            'mimes' => ':attribute hanya bole jpg, jpeg atau png'
        ];

        $this->validate($request, [
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required|regex:/^[0-9]+$/',
            'foto' => 'mimes:jpg,jpeg,png'

        ], $message);

        if (empty($request->foto)) {
            $request['foto'] = null;
        }

        dd($request);
    }

    public function detailPenghuni(Request $request)
    {
        $return = $this->Penghuni->detail_penghuni($request->id);
        return $return;
    }

    public function getEditPenghuni(Request $request)
    {
        $return = $this->Penghuni->detail_penghuni($request->id);
        return $return;
    }
}
