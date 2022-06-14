<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\HistoryObat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FarmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->Obat = new Obat();
        $this->HistoryObat = new HistoryObat();
        $this->kode_7_options = [
            '01' => '01 - Kapsul',
            '23' => '23 - Powder/Serbuk Oral',
            '43' => '43 - Injeksi',
            '02' => '02 - Kapsul Lunak',
            '24' => '24 - Bedak/Talk',
            '44' => '44 - Injeksi Suspensi Kering',
            '04' => '04 - Kaplet',
            '28' => '28 - Gel',
            '09' => '09 - Kaplet Salut Film',
            '29' => '29 - Krim, Krim Steril',
            '46' => '46 - Tetes Mata',
            '10' => '10 - Tablet',
            '30' => '30 - Salep',
            '47' => '47 - Tetes Hidung',
            '11' => '11 - Tablet Effervescent',
            '31' => '31 - Salep Mata',
            '48' => '48 - Tetes Telinga',
            '12' => '12 - Tablet Hisap',
            '32' => '32 - Emulsi',
            '49' => '49 - Infus',
            '14' => '14 - Tablet Lepas Terkontrol',
            '33' => '33 - Suspensi',
            '53' => '53 - Supositoria, Ovula',
            '34' => '34 - Elixir',
            '56' => '56 - Nasal Spray',
            '15' => '15 - Tablet Salut Enterik',
            '36' => '36 - Drops',
            '58' => '58 - Rectal Tube',
            '16' => '16 - Pil',
            '37' => '37 - Sirup/Larutan',
            '62' => '62 - Inhalasi',
            '17' => '17 - Tablet Salut Selaput',
            '38' => '38 - Suspensi Kering',
            '63' => '63 - Tablet Kunyah',
            '22' => '22 - Granul',
            '41' => '41 - Lotion/Solution',
            '81' => '81 - Tablet Dispersi',
        ];
    }

    public function index()
    {
        // $query = $request->get('query');
        return view('farmasi/index');
    }

    public function data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'namaobat',
            2 => 'stok',
            3 => 'action',
        );

        $totalData = Obat::where('deleted', 0)->count() - 1;
        $totalFiltered = $totalData;
        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        if (empty($request->input('search.value'))) {
            $obat = $this->Obat->daftar_obat('', $start, $limit, $order, $dir);
        } else {
            $search = $request->input('search.value');
            $obat = $this->Obat->daftar_obat($search, $start, $limit, $order, $dir);
            $totalFiltered = $this->Obat->total_daftar_obat($search);
            $totalData = $obat->count();
        }

        $data = array();

        foreach ($obat as $key => $p) {
            // $penghuni = $this->Penghuni->detail_penghuni($p->id_penghuni);
            $row['id'] = $start + $key + 1;
            $row['nama_kode_obat'] = "$p->namaobat<br><span class='italic'>$p->kode_slug</span>";
            if ($p->stok == null) {
                $row['stock'] = 0;
            } else {
                $row['stock'] = $p->stok;
            }
            $row['action'] =
                '<a href="' . route('farmasi.transaksi', [$p->id]) . '" class="text-indigo-400 font-medium text-lg hover:border-b-2 hover:border-indigo-900 hover:pb-1 hover:text-indigo-900 transition duration-200" id="details" data-id="' . $p->id . '">Detail Transaksi</a>
                <span class="border-l-2 mx-2 border border-slate-400"></span>
                <a href="' . route('farmasi.edit_obat', [$p->id]) . '" class="text-indigo-400 font-medium text-lg hover:border-b-2 hover:border-indigo-900 hover:pb-1 hover:text-indigo-900 transition duration-200" id="edit" data-id="' . $p->id . '">Edit</a>
                <span class="border-l-2 mx-2 border border-slate-400"></span>
                <a href="' . route('farmasi.tambah_transaksi', ['id_obat' => $p->id]) . '" class="text-indigo-400 font-medium text-lg hover:border-b-2 hover:border-indigo-900 hover:pb-1 hover:text-indigo-900 transition duration-200" id="tambahTransaksi" data-id="' . $p->id . '">+ Transaksi</a>
                <span class="border-l-2 mx-2 border border-slate-400"></span>
                <a href="#" @click="modalKonfirmasiDelete = true; namaobat = \'' . $p->namaobat . '\'; id_obat = \'' . $p->id . '\'" class="text-indigo-400 font-medium text-lg hover:border-indigo-900 hover:border-b-2 hover:pb-1 hover:text-indigo-900 transition duration-200" id="hapus-' . $p->id . '" data-id="' . $p->id . '">Hapus</a>
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

    public function transaksi($id_obat)
    {
        $data['obat'] = $this->Obat::detail_obat($id_obat);
        $data['stok'] = $this->HistoryObat->stok_obat($id_obat);
        return view('farmasi/transaksi', $data)->render();
    }

    public function tambah_transaksi($id_obat = null)
    {
        $data['obat'] = $this->Obat::daftar_obat_all();
        $data['id_obat'] = $id_obat;

        return view('farmasi/tambah_transaksi', $data)->render();
    }

    public function proses_tambah_transaksi(Request $request)
    {
        $data['id_obat'] = $request->input('id_obat');
        $data['stokobat'] = $request->input('stokobat');
        $data['keterangan'] = $request->input('keterangan');

        $this->HistoryObat->simpan($data, '');

        return redirect(route('farmasi.transaksi', [$data['id_obat']]))->with('message', 'Transaksi berhasil ditambahkan');
    }

    public function edit_transaksi($id_history)
    {
        $data['history'] = $this->HistoryObat::detail_histori($id_history);
        $data['obat'] = $this->Obat::detail_obat($data['history']->id_obat);

        return view('farmasi/edit_transaksi', $data)->render();
    }

    public function proses_edit_transaksi(Request $request)
    {
        $data['id'] = $request->input('id');
        $data['id_obat'] = $request->input('id_obat');
        $data['stokobat'] = $request->input('stokobat');
        $data['keterangan'] = $request->input('keterangan');

        $this->HistoryObat->simpan($data, 'id');

        return redirect(route('farmasi.transaksi', [$data['id_obat']]))->with('message', 'Transaksi berhasil diedit');
    }

    public function edit_obat($id_obat)
    {
        $data['obat'] = $this->Obat::detail_obat($id_obat);
        $data['kode_7_opt'] = $this->kode_7_options;

        return view('farmasi/edit_obat', $data)->render();
    }

    public function proses_edit_obat(Request $request)
    {
        $data[0]['kode_slug'] = [];
        for ($i = 1; $i < 10; $i++) {
            $data[0]['kode_slug'][] = $request->input('kode_' . $i);
            $data[0]['kode_' . $i] = $request->input('kode_' . $i);
        }
        $data[0]['kode_slug'] = join($data[0]['kode_slug']);
        $data[0]['id'] = $request->input('id');
        $data[0]['namaobat'] = $request->input('namaobat');
        $this->Obat->simpan($data, "id");

        return redirect(route('farmasi.index'))->with('message', 'Data obat <strong>' . $request->input('namaobat') . '</strong> berhasil diedit');
    }

    public function transaksi_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'keterangan',
            2 => 'stokobat',
            3 => 'created_at',
            4 => 'action',
        );

        $id_obat = $request->input('id');

        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = empty($request->input('search.value')) ? '' : $request->input('search.value');
        $startDate = empty($request->input('startDate')) ? '' : $request->input('startDate');
        $endDate = empty($request->input('endDate')) ? '' : $request->input('endDate');
        $obat = $this->HistoryObat->histori($search, $id_obat, $start, $limit, $order, $dir, $startDate, $endDate);
        $totalData = $this->HistoryObat->histori_count($search, $id_obat)->total;
        $totalFiltered = $totalData;
        $data = array();
        foreach ($obat as $key => $p) {
            // $penghuni = $this->Penghuni->detail_penghuni($p->id_penghuni);
            $row['id'] = $start + $key + 1;
            $row['keterangan'] = $p->keterangan;
            $row['stock'] = $p->stokobat;
            $row['waktu'] = $p->created_at->format('d M Y - h:i');
            $row['action'] =
                '<a href="' . route('farmasi.edit_transaksi', [$p->id]) . '" class="text-indigo-400 font-medium text-lg hover:border-indigo-900 hover:border-b-2 hover:pb-1 hover:text-indigo-900 transition duration-200" id="edit" data-id="' . $p->id . '">Edit</a>
                <span class="border-l-2 mx-2 border-slate-400"></span>
                <a href="#" @click="modalKonfirmasiDelete = true; id_obat = \'' . $p->id_obat . '\'; keterangan = \'' . $p->keterangan . '\'; id_transaksi = \'' . $p->id . '\'; stok = \'' . $p->stokobat . '\'; waktu = \'' . $p->updated_at->format('d M Y - h:i') . '\'" class="text-indigo-400 font-medium text-lg hover:border-indigo-900 hover:border-b-2 hover:pb-1 hover:text-indigo-900 transition duration-200" id="hapus-' . $p->id . '" data-id="' . $p->id . '">Hapus</a>
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
    // OLD

    public function fetch_data(Request $request)
    {
        $query = $request->input('query');
        $query = str_replace(" ", "%", $query);

        $data['query'] = $query;
        $data['data'] = Obat::daftar_obat($query);

        $data['count'] = $data['data']->count();

        return view('listobat/obat_data', $data)->render();
    }

    public function proses_hapus_obat(Request $request)
    {
        $id = $request->input('id_obat');
        $this->Obat->delete_obat($id);
        return redirect(route('farmasi.index'))->with('message', "Obat <strong>" . $request->input('namaobat') . "</strong> berhasil dihapus");
    }

    public function proses_hapus_transaksi(Request $request)
    {
        $id = $request->input('id_transaksi');
        $id_obat = $request->input('id_obat');
        $this->HistoryObat->delete_transaksi($id);
        return redirect(route('farmasi.transaksi', $id_obat))->with('message', "Transaksi berhasil dihapus");
    }

    public function tambah_obat()
    {
        $data['kode_7_opt'] = $this->kode_7_options;
        return view('farmasi/tambah_obat', $data);
    }

    public function proses_tambah_obat(Request $request)
    {
        $message = [
            'required' => 'Harap isi :attribute',
            'same' => ':other tidak sesuai dengan :attribute',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute minimal :max karakter',
            'integer' => ':attribute hanya boleh karakter angka saja',
            'date' => ':attribute tidak valid',
            'nik.regex' => ':attribute hanya boleh angka saja',
            'mimes' => ':attribute hanya boleh jpg, jpeg atau png'
        ];

        $this->validate($request, [
            'namaobat' => 'required',
            'kode_1' => 'required',
            'kode_2' => 'required',
            'kode_3' => 'required',
            'kode_4' => 'required',
            'kode_5' => 'required',
            'kode_6' => 'required',
            'kode_7' => 'required',
            'kode_8' => 'required',
            'kode_9' => 'required',
        ], $message, [
            'namaobat' => 'Nama Obat',
            'kode_1' => 'Merk Obat',
            'kode_2' => 'Tipe Obat',
            'kode_3' => 'Asal Obat',
            'kode_4' => 'Tahun Regristrasi',
            'kode_5' => 'Nomor Urut Pabrik',
            'kode_6' => 'Nomor Urut Obat',
            'kode_7' => 'Bentuk Sediaan Obat',
            'kode_8' => 'Kekuatan Sediaan Obat',
            'kode_9' => 'Bentuk Kemasan Obat',
        ]);

        $data['kode_slug'] = join([
            $request->input('kode_1'),
            $request->input('kode_2'),
            $request->input('kode_3'),
            $request->input('kode_4'),
            $request->input('kode_5'),
            $request->input('kode_6'),
            $request->input('kode_7'),
            $request->input('kode_8'),
            $request->input('kode_9')
        ]);

        $data['kode_1'] = $request->input('kode_1');
        $data['kode_2'] = $request->input('kode_2');
        $data['kode_3'] = $request->input('kode_3');
        $data['kode_4'] = $request->input('kode_4');
        $data['kode_5'] = $request->input('kode_5');
        $data['kode_6'] = $request->input('kode_6');
        $data['kode_7'] = $request->input('kode_7');
        $data['kode_8'] = $request->input('kode_8');
        $data['kode_9'] = $request->input('kode_9');
        $data['namaobat'] = $request->input('namaobat');
        $data['keterangan'] = ' ';
        $data['deleted'] = 0;

        $this->Obat->tambah($data);
        return redirect(route("farmasi.index"))->with('message', "Obat <strong>" . $data['namaobat'] . "</strong> berhasil ditambahkan");
    }

    public function simpan_obat(Request $request)
    {
        $jenisform = $request->input('tipeForm');
        $data = $request->except(['_token', 'tipeForm']);
        $data['keterangan'] = ($data['keterangan'] == NULL) ? ' ' : $data['keterangan'];
        if ($jenisform == 'auto') {
            $data['kode_slug'] = "";
            for ($i = 1; $i < 10; $i++) {
                $data['kode_slug'] .= $data["kode_$i"];
            }
        } else {
            $data["kode_1"] = $data['kode_slug'][0];
            $data["kode_2"] = $data['kode_slug'][1];
            $data["kode_3"] = $data['kode_slug'][2];
            $data["kode_4"] = $data['kode_slug'][3] + $data['kode_slug'][4];
            $data["kode_5"] = $data['kode_slug'][5] + $data['kode_slug'][6] + $data['kode_slug'][7];
            $data["kode_6"] = $data['kode_slug'][8] + $data['kode_slug'][9] + $data['kode_slug'][10];
            $data["kode_7"] = $data['kode_slug'][11] + $data['kode_slug'][12];
            $data["kode_8"] = $data['kode_slug'][13];
            $data["kode_9"] = $data['kode_slug'][14];
        }
        Obat::tambah($data);
        return redirect(url("/daftar_obat"))->with('message', "Obat <strong>" . $data['namaobat'] . "</strong> berhasil ditambahkan");
    }

    public function detail($id)
    {
        $data['id'] = $id;
        $data['obat'] = Obat::total_stok($id);
        $data['history'] = HistoryObat::where('id_obat', '=', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(7);

        return view('detailobat/detail_obat', $data);
    }

    public function detail_data($id, Request $request)
    {
        // return dd($request->all());
        $data['history'] = HistoryObat::search_data($request->all(), $id);

        return view('detailobat/detail_data', $data)->render();
    }

    public function tambah_stok($id_obat)
    {
        $data['data'] = (object) ['id_obat' => $id_obat];
        $data['obat'] = Obat::select('namaobat')->where('id', $id_obat)->first();
        $data['edit'] = false;

        return view('detailobat/tambah_stok', $data)->render();
    }

    public function kurang_stok($id_obat)
    {
        $data['data'] = (object) ['id_obat' => $id_obat];
        $data['obat'] = Obat::select('namaobat')->where('id', $id_obat)->first();
        $data['edit'] = false;
        return view('detailobat/kurang_stok', $data)->render();
    }

    public function edit_stok($id, $trans)
    {
        $data['id'] = $id;
        $data['data'] = HistoryObat::where('id', $id)->first();
        $data['obat'] = Obat::select('namaobat')->where('id', $data['data']->id_obat)->first();
        $data['edit'] = true;
        // return dd($data);
        if ($trans == 'tambah') {
            $data['mtp'] = 1;
            return view('detailobat/tambah_stok', $data)->render();
        } else {
            $data['mtp'] = -1;
            return view('detailobat/kurang_stok', $data)->render();
        }
    }

    public function konfirmasi_delete_stok($id)
    {
        $data['transaksi'] = HistoryObat::join('tb_obat', 'tb_obat.id', '=', 'tb_history_obat.id_obat')
            ->select('tb_history_obat.id', 'tb_obat.id as id_obat', 'tb_history_obat.created_at', 'tb_history_obat.keterangan', 'tb_history_obat.stokobat', 'tb_obat.namaobat')
            ->where('tb_history_obat.id', $id)
            ->first();
        return view('detailobat/hapus_konfirmasi', $data);
    }

    public function delete_stok(Request $request)
    {
        $id_obat = $request->input('id_obat');
        $id = $request->input('id');
        HistoryObat::deletes($id);
        if ($request->input('trans_all')) {
            return redirect(url("/transaksi_obat"))->with('message', "Data berhasil dihapus");
        } else {
            return redirect(url("/detail_obat/$id_obat"))->with('message', "Data berhasil dihapus");
        }
    }

    public function simpan_stok(Request $request)
    {
        $data = $request->only(['keterangan', 'id_obat', 'stokobat', 'id']);
        $mtp = $request->input('multiplier');

        if ($data['keterangan'] == NULL) {
            $data['keterangan'] = ' ';
        }

        $data['stokobat'] *= $mtp;
        $id_obat = $request->input('id_obat');

        HistoryObat::simpan($data, ['id']);
        if ($request->input('trans_all')) {
            return redirect(url("/transaksi_obat"))->with('message', "Data berhasil disimpan");
        } else {
            return redirect(url("/detail_obat/$id_obat"))->with('message', "Data berhasil disimpan");
        }
    }

    public function konfirmasi_delete_transaksi($id)
    {
        $data['transaksi'] = HistoryObat::join('tb_obat', 'tb_obat.id', '=', 'tb_history_obat.id_obat')
            ->select('tb_history_obat.id', 'tb_obat.id as id_obat', 'tb_history_obat.created_at', 'tb_history_obat.keterangan', 'tb_history_obat.stokobat', 'tb_obat.namaobat')
            ->where('tb_history_obat.id', $id)
            ->first();
        $data['trans_all'] = true;
        return view('detailobat/hapus_konfirmasi', $data);
    }
}
