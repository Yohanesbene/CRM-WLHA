<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Mobilitas extends Model
{
    use HasFactory;
    protected $table = 'mobilitas';

    public static function daftar_mobilitas($query = "", $start, $limit, $order, $dir)
    {
        if ($query == "") {
            $data = Mobilitas::join('penghuni', 'mobilitas.id_penghuni', '=', 'penghuni.id')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get(['mobilitas.*', 'penghuni.no_induk', 'penghuni.id as p_id', 'penghuni.nama']);
        } else {
            $data = Mobilitas::join('penghuni', 'mobilitas.id_penghuni', '=', 'penghuni.id')
                        ->where('nama', 'like', "%" . $query . "%")
                        ->orWhere('tujuan', 'like', "%" . $query . "%")
                        ->orWhere('no_induk', 'like', "%" . $query . "%")
                        ->orWhere('petugas_keluar', 'like', "%" . $query . "%")
                        ->orWhere('petugas_kembali', 'like', "%" . $query . "%")
                        ->orWhere('penghuni.no_induk', 'like', "%" . $query . "%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get(['mobilitas.*', 'penghuni.no_induk', 'penghuni.id as p_id', 'penghuni.nama']);
        }

        return $data;
    }

    public static function detail_mobilitas($id)
    {
        $data = Mobilitas::where('id', $id)
            ->first();

        return $data;
    }

    public static function mobilitas_pulang($id, $kembali, $petugas)
    {
        Mobilitas::where('id', $id)
            ->update([
                'kembali' => $kembali,
                'petugas_kembali' => $petugas,
                'timestamp_kembali' => Carbon::now()
            ]);
    }

    public static function mobilitas_edit($id, $id_penghuni, $tujuan, $keluar, $petugas_keluar, $kembali, $petugas_kembali)
    {
        Mobilitas::where('id', $id)
            ->update([
                'id_penghuni' => $id_penghuni,
                'tujuan' => $tujuan,
                'keluar' => $keluar,
                'petugas_keluar' => $petugas_keluar,
                'kembali' => $kembali,
                'petugas_kembali' => $petugas_kembali,
                'timestamp_keluar' => Carbon::now(),
                'timestamp_kembali' => Carbon::now()
            ]);
    }
}
