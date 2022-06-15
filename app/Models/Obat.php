<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoryObat;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'tb_obat';

    public function __construct()
    {
        $this->HistoryObat = new HistoryObat();
    }

    public function historyObat()
    {
        return $this->hasMany(HistoryObat::class, 'id_obat', 'id');
    }

    public static function search($query)
    {
        $data = Obat::where('namaobat', 'like', "%" . $query . "%")->paginate(15);

        return $data;
    }

    public static function tambah($data)
    {
        Obat::insert($data);
    }

    public static function simpan($data, $condition)
    {
        Obat::upsert($data, $condition);
    }

    public static function total_stok($id)
    {
        $data = Obat::withSum('historyObat as stokobat', 'stokobat')
            ->where('id', '=', $id)->first();
        // $total_stok = $data->historyObat()->sum('stokobat');
        return $data;
    }

    public static function daftar_obat_all()
    {
        $data = Obat::where('tb_obat.deleted', '0')
            ->get(['id', 'kode_slug', 'namaobat']);
        return $data;
    }

    public static function daftar_obat($query = "", $start, $limit, $order, $dir)
    {
        if ($query == "") {
            $data = Obat::selectRaw('tb_obat.id, tb_obat.kode_slug, tb_obat.namaobat, sum(tb_history_obat.stokobat) as stok')
                ->leftJoin('tb_history_obat', 'tb_history_obat.id_obat', '=', 'tb_obat.id')
                ->where('tb_obat.deleted', '0')
                ->where(function ($q) {
                    $q->where('tb_history_obat.deleted', 0)
                        ->orWhere('tb_history_obat.deleted', null);
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->groupBy('tb_history_obat.id_obat', 'tb_obat.id', 'tb_obat.kode_slug', 'tb_obat.namaobat')
                ->get();
        } else {
            $data = Obat::selectRaw('tb_obat.id, tb_obat.kode_slug, tb_obat.namaobat, sum(tb_history_obat.stokobat) as stok')
                ->leftJoin('tb_history_obat', 'tb_history_obat.id_obat', '=', 'tb_obat.id')
                ->where('tb_obat.deleted', 0)
                ->where(function ($q) {
                    $q->where('tb_history_obat.deleted', 0)
                        ->orWhere('tb_history_obat.deleted', null);
                })
                ->where(function ($q) use ($query) {
                    $q->where('tb_obat.namaobat', 'like', "%" . $query . "%")
                        ->orWhere('tb_obat.kode_slug', 'like', "%" . $query . "%");
                })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->groupBy('tb_history_obat.id_obat', 'tb_obat.id', 'tb_obat.kode_slug', 'tb_obat.namaobat')
                ->get();
        }
        return $data;
    }

    public static function find_obat($query)
    {
        $data = Obat::where('deleted', 0)
            ->where(function ($q) use ($query) {
                $q->where('namaobat', 'like', "%" . $query . "%")
                    ->orWhere('kode_slug', 'like', "%" . $query . "%");
            })
            ->get(['id', 'kode_slug', 'namaobat']);

        return $data;
    }

    public static function total_daftar_obat($query = "")
    {
        if ($query == "") {
            $data = Obat::offset($start)
                ->where('deleted', 0)
                ->count();
        } else {
            $data = Obat::where('deleted', 0)
                ->where(function ($q) use ($query) {
                    $q->where('namaobat', 'like', "%" . $query . "%")
                        ->orWhere('kode_slug', 'like', "%" . $query . "%");
                })
                ->count();
        }
        return $data;
    }

    public static function detail_obat($id_obat)
    {
        $data = Obat::where('id', $id_obat)->first();
        return $data;
    }

    public static function delete_obat($id_obat)
    {
        Obat::where('id', $id_obat)->update(['deleted' => 1]);
    }
}
