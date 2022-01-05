<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HistoryObat;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'tb_obat';

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

    public static function total_stok($id)
    {
        $data = Obat::withSum('historyObat as stokobat', 'stokobat')
            ->where('id', '=', $id)->first();
        // $total_stok = $data->historyObat()->sum('stokobat');
        return $data;
    }

    public static function daftar_obat($query = NULL)
    {
        $data = Obat::withSum('historyObat as stokobat', 'stokobat');

        if ($query != NULL) {
            $data->where('namaobat', 'like', '%' . $query . '%')
                ->orWhere('kode_slug', 'like', '%' . $query . '%')
                ->orWhere('id', 'like', '%' . $query . '%');
        }
        return $data->paginate(7);
    }
}
