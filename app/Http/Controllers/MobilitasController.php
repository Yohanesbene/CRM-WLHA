<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Models\User;
use App\Models\Mobilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class MobilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->Mobilitas = new Mobilitas();
        $this->Penghuni = new Penghuni();
        $this->Pegawai = new User();
    }

    public function mobilitas()
    {
        // $data['mobilitas'] = $this->Mobilitas->daftar_mobilitas();
        return view('mobilitas.index');
    }

    public function dataMobilitas(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'no_induk',
            2 => 'nama',
            3 => 'tujuan',
            4 => 'keluar',
            5 => 'kembali',
            6 => 'action'
        );

        $totalData = Mobilitas::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $mobilitas = $this->Mobilitas->daftar_mobilitas('', $start, $limit, $order, $dir);
        }
        else
        {
            $search = $request->input('search.value');
            $mobilitas = $this->Mobilitas->daftar_mobilitas($search, $start, $limit, $order, $dir);

            $totalData = $obat->count();
            $totalFiltered = $totalData;
        }
        $data = array();

        foreach ($mobilitas as $key => $p) {
            // $penghuni = $this->Penghuni->detail_penghuni($p->id_penghuni);
            $row['id'] = $start+$key+1;
            $row['no_induk_nama'] = "$p->no_induk<br>$p->nama";
            $row['tujuan'] = $p->tujuan;
            $row['keluar'] = "$p->keluar<br>$p->petugas_keluar";
            if ($p->kembali == null){
                $row['kembali'] = "<a href='".route('mobilitas.pulang', [$p->id])."' class='text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200'>+ Input Data</a>";
            } else {
                $row['kembali'] = "$p->kembali<br>$p->petugas_kembali";
            }
            $row['action'] =
                    '<button class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" @click="modalDetailMobilitas = true" id="details" data-id="'. $p->id .'">Detail</button>
                    <br>
                    <a href="'. route('mobilitas.edit', [$p->id]) .'" class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" id="edit" data-id="'. $p->id .'">Edit</a>
                    <br>
                    <a href="'. route('penghuni.ubah', [$p->id]) .'" class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" id="edit" data-id="'. $p->id .'">Hapus</a>
                    ';
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

    public function tambahMobilitas()
    {
        $data['penghuni'] = $this->Penghuni::get();
        $data['time'] = Carbon::now();
        return view('mobilitas.tambah')->with($data);
    }

    public function prosesTambahMobilitas(Request $request)
    {
        $message = [
            'required' => 'Harap isi :attribute',
            'date' => 'date_format:Y-m-d\TH:i'
        ];

        $this->validate($request, [
            'tujuan' => 'required',
            'kembali' => 'date'
        ], $message);

        // dd($request);
        $message_success = ['message_success' => ['Data Berhasil Disimpan']];
        return redirect()->route('mobilitas.index')->with($message_success);
    }


    public function pulangMobilitas($id_mobilitas)
    {
        $data['mobilitas'] = $this->Mobilitas::detail_mobilitas($id_mobilitas);
        $data['penghuni'] = $this->Penghuni::detail_penghuni($data['mobilitas']['id_penghuni']);
        // dd($data['mobilitas']);
        return view('mobilitas.pulang')->with($data);
    }

    public function tambahPulangMobilitas(Request $request)
    {
        $id_pegawai = session()->get('auth_wlha.0');
        $this->Mobilitas::mobilitas_pulang($request->input('id'), $request->input('kembali'), $id_pegawai->id);
        $message_success = ['message_success' => ['Data Berhasil Disimpan']];
        return redirect()->route('mobilitas.index')->with($message_success);
    }

    public function editMobilitas($id_mobilitas)
    {
        $data['mobilitas'] = $this->Mobilitas::detail_mobilitas($id_mobilitas);
        $data['penghuni'] = $this->Penghuni::get();
        $data['pegawai'] = $this->Pegawai::get();
        return view('mobilitas.edit')->with($data);
    }

    public function prosesEditMobilitas(Request $request)
    {
        $message = [
            'required' => 'Harap isi :attribute',
            'date' => 'date_format:Y-m-d\TH:i'
        ];

        $this->validate($request, [
            'IDPenghuni' => 'required',
            'tujuan' => 'required',
            'petugasKembali' => 'required',
            'kembali' => 'date',
            'petugasKeluar' => 'required',
            'keluar' => 'date',
        ], $message);

        $id = $request['id_mobilitas'];
        $id_penghuni = $request['IDPenghuni'];
        $tujuan = $request['tujuan'];
        $keluar  = $request['keluar'];
        $petugas_keluar = $request['petugasKeluar'];
        $kembali = $request['kembali'];
        $petugas_kembali = $request['petugasKembali'];

        $this->Mobilitas->mobilitas_edit($id, $id_penghuni, $tujuan, $keluar, $petugas_keluar, $kembali, $petugas_kembali);

        $message_success = ['message_success' => ['Data Berhasil Disimpan']];
        return redirect()->route('mobilitas.index')->with($message_success);
    }

    public function detailMobilitas(Request $request)
    {
        $id = $request['id'];

        $data['mobilitas'] = $this->Mobilitas->detail_mobilitas($id);
        $data['penghuni'] = $this->Penghuni->detail_penghuni($data['mobilitas']->id_penghuni);

        return $data;
    }
}
