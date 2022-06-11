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
            2 => 'stock',
            3 => 'action',
        );

        $totalData = Obat::where('deleted', 0)->count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $obat = $this->Obat->daftar_obat('', $start, $limit, $order, $dir);
        }
        else
        {
            $search = $request->input('search.value');
            $obat = $this->Obat->daftar_obat($search, $start, $limit, $order, $dir);
            $totalFiltered = $this->Obat->total_daftar_obat($search);
            $totalData = $totalFiltered;
        }
        $data = array();

        foreach ($obat as $key => $p) {
            // $penghuni = $this->Penghuni->detail_penghuni($p->id_penghuni);
            $row['id'] = $start+$key+1;
            $row['nama_kode_obat'] = "$p->namaobat<br><span class='italic'>$p->kode_slug</span>";
            $row['stock'] = $this->HistoryObat->stok_obat($p->id);
            $row['action'] =
                    '<a href="'. route('farmasi.transaksi', [$p->id]).'" class="text-indigo-400 font-medium text-lg hover:border-b-2 hover:border-indigo-900 hover:pb-1 hover:text-indigo-900 transition duration-200" id="details" data-id="'. $p->id .'">Detail</a>
                    &nbsp;
                    <a href="'. route('mobilitas.edit', [$p->id]) .'" class="text-indigo-400 font-medium text-lg hover:border-b-2 hover:border-indigo-900 hover:pb-1 hover:text-indigo-900 transition duration-200" id="edit" data-id="'. $p->id .'">Edit</a>
                    &nbsp;
                    <a href="'. route('farmasi.tambah_transaksi', ['id_obat' => $p->id]) .'" class="text-indigo-400 font-medium text-lg hover:border-b-2 hover:border-indigo-900 hover:pb-1 hover:text-indigo-900 transition duration-200" id="tambahTransaksi" data-id="'. $p->id .'">+ Transaksi</a>
                    &nbsp;
                    <a href="#" @click="modalKonfirmasiDelete = true; nama_obat = \''. $p->namaobat .'\'; id_obat = \''. $p->id .'\'" class="text-indigo-400 font-medium text-lg hover:border-indigo-900 hover:border-b-2 hover:pb-1 hover:text-indigo-900 transition duration-200" id="hapus-'.$p->id.'" data-id="'. $p->id .'">Hapus</a>
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

        return view('farmasi/tambahtransaksi', $data)->render();
    }

    public function edit_transaksi($id_history)
    {
        $data['history'] = $this->HistoryObat::detail_histori($id_history);
        $data['obat'] = $this->Obat::detail_obat($data['history']->id_obat);

        return view('farmasi/edittransaksi', $data)->render();
    }

    public function transaksi_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'keterangan',
            2 => 'stock',
            3 => 'waktu',
            4 => 'action',
        );

        $id_obat = $request->input('id');

        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = empty($request->input('search.value')) ? '' : $request->input('search.value');
        $obat = $this->HistoryObat->histori($search, $id_obat, $start, $limit, $order, $dir);
        $totalData = $this->HistoryObat->histori_count($search, $id_obat)->total;
        $totalFiltered = $totalData;
        $data = array();
        foreach ($obat as $key => $p) {
            // $penghuni = $this->Penghuni->detail_penghuni($p->id_penghuni);
            $row['id'] = $start+$key+1;
            $row['keterangan'] = $p->keterangan;
            $row['stock'] = $p->stokobat;
            $row['waktu'] = $p->updated_at->format('Y-m-d h:i');
            $row['action'] =
                    '<a href="'. route('farmasi.edit_transaksi', [$p->id]) .'" class="text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200" id="edit" data-id="'. $p->id .'">Edit</a>
                    &nbsp;
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

    public function tambah_obat()
    {
        return view('farmasi/tambah_obat');
    }

    public function proses_tambah_obat(Request $request)
    {
        dd($request);
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
