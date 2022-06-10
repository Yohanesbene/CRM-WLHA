<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\HistoryObat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $query = $request->get('query');
        $data['data'] = Obat::daftar_obat('', 0, 10, 'id', 'asc');
        $data['count'] = $data['data']->count();
        $data['query'] = '';
        return view('listobat/index', $data);
    }

    public function fetch_data(Request $request)
    {
        $query = $request->input('query');
        $query = str_replace(" ", "%", $query);

        $data['query'] = $query;
        $data['data'] = Obat::daftar_obat($query);

        $data['count'] = $data['data']->count();

        return view('listobat/obat_data', $data)->render();
    }

    public function deleteConfirm($id)
    {
        $data['obat'] = Obat::where('id', '=', $id)->first();
        return view('listobat/hapus_konfirmasi', $data);
    }

    public function delete_obat(Request $request)
    {
        $id = $request->input('noobat');
        Obat::where('id', $id)->delete();
        return redirect(url('/daftar_obat'))->with('message', "Obat <strong>" . $request->input('namaobat') . "</strong> berhasil dihapus");
    }

    public function tambah_obat($form = 'manual', $obat)
    {
        $data['obat'] = $obat;
        $data['form'] = $form;
        return view('listobat/tambah_obat', $data);
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

    public function transaksi()
    {
        $data['history'] = HistoryObat::join('tb_obat', 'tb_obat.id', '=', 'tb_history_obat.id_obat')
            ->select('tb_history_obat.*', 'tb_obat.namaobat', 'tb_obat.kode_slug')
            ->orderBy('updated_at', 'desc')->paginate(7);
        return view('transaksiobat/index', $data);
    }

    public function transaksi_data(Request $request)
    {
        $data['history'] = HistoryObat::search_transaksi($request);
        return view('transaksiobat/data_transaksi', $data)->render();
    }

    public function edit_transaksi($id, $trans)
    {
        $data['id'] = $id;
        $data['data'] = HistoryObat::where('id', $id)->first();
        $data['obat'] = Obat::select('namaobat')->where('id', $data['data']->id_obat)->first();
        $data['trans_all'] = true;
        $data['edit'] = true;

        if ($trans == 'tambah') {
            $data['mtp'] = 1;
            return view('detailobat/tambah_stok', $data)->render();
        } else {
            $data['mtp'] = -1;
            return view('detailobat/kurang_stok', $data)->render();
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
