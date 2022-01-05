<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Obat;
use Illuminate\Support\Carbon;

class HistoryObat extends Model
{
    use HasFactory;
    protected $table = 'tb_history_obat';

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public static function simpan($data, $cond)
    {
        HistoryObat::upsert($data, $cond);
    }

    public static function deletes($id)
    {
        HistoryObat::where('id', '=', $id)->delete();
    }

    public static function search_data($request, $id)
    {
        $fromDate = Carbon::createFromFormat('d-m-Y', $request['from'])->format('Y-m-d');
        $untilDate = Carbon::createFromFormat('d-m-Y', $request['until'])->format('Y-m-d');
        $query = str_replace(" ", "%", $request['query']);
        return HistoryObat::where('keterangan', 'like', '%' . $query . '%')
            ->where('id_obat', $id)
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $untilDate)
            ->orderBy('updated_at', 'desc')
            ->paginate(7);
    }

    public static function search_transaksi($request)
    {
        $fromDate = Carbon::createFromFormat('d-m-Y', $request['from'])->format('Y-m-d');
        $untilDate = Carbon::createFromFormat('d-m-Y', $request['until'])->format('Y-m-d');
        $query = str_replace(" ", "%", $request['query']);

        return HistoryObat::join('tb_obat', 'tb_obat.id', '=', 'tb_history_obat.id_obat')
            ->select('tb_history_obat.*', 'tb_obat.namaobat', 'tb_obat.kode_slug')
            ->where('tb_history_obat.keterangan', 'like', '%' . $query . '%')
            ->orWhere('tb_history_obat.id_obat', 'like', '%' . $query . '%')
            ->orWhere('tb_obat.namaobat', 'like', '%' . $query . '%')
            ->orWhere('tb_obat.kode_slug', 'like', '%' . $query . '%')
            ->whereDate('tb_history_obat.created_at', '>=', $fromDate)
            ->whereDate('tb_history_obat.created_at', '<=', $untilDate)
            ->orderBy('tb_history_obat.updated_at', 'desc')
            ->paginate(7);
    }
}
