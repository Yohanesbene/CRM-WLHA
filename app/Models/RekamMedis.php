<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekamMedis extends Model
{
    use HasFactory;

    public static function get_detail_medis_data($table_name, $id_penghuni, $search, $start, $limit, $order, $dir, $startDate = "", $endDate = "")
    {
        $data = DB::table($table_name)
            ->where('id_penghuni', $id_penghuni)
            ->where($table_name . '.deleted', 0)
            ->where(function ($q) use ($search, $table_name) {
                if ($search != '') {
                    $q->where($table_name . '.id_pegawai', 'like', '%' . $search . '%')
                        ->orWhere(function ($q2) use ($table_name, $search) {
                            if ($table_name == 'mcu_tekanan_darah') {
                                $q2->where($table_name . '.sistole', 'like', '%' . $search . '%')
                                    ->orWhere($table_name . '.diastole', 'like', '%' . $search . '%');
                            } else if ($table_name == 'mcu_nutrisi' || $table_name ==  'mcu_urine' || $table_name ==  'mcu_bab' || $table_name ==  'mcu_cairan') {
                                $q2->where($table_name . '.pagi', 'like', '%' . $search . '%')
                                    ->orWhere($table_name . '.siang', 'like', '%' . $search . '%')
                                    ->orWhere($table_name . '.sore', 'like', '%' . $search . '%');
                            } else {
                                $q2->where($table_name . '.hasil', 'like', '%' . $search . '%');
                            }
                        });
                }
            })
            ->where(function ($q) use ($startDate, $endDate, $table_name) {
                if ($startDate != '' && $endDate != '') {
                    $q->whereDate($table_name . '.waktu', '>=', $startDate)
                        ->whereDate($table_name . '.waktu', '<=', $endDate);
                }
            })
            ->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)
            ->get();

        return $data;
    }

    public static function count_detail_medis_data($table_name, $id_penghuni, $search, $startDate = "", $endDate = "")
    {
        $totalData = DB::table($table_name)
            ->where('id_penghuni', $id_penghuni)
            ->where($table_name . '.deleted', 0)
            ->where(
                function ($q) use ($search, $table_name) {
                    if ($search != '') {
                        $q->where($table_name . '.id_pegawai', 'like', '%' . $search . '%')
                            ->orWhere(function ($q2) use ($table_name, $search) {
                                if ($table_name == 'mcu_tekanan_darah') {
                                    $q2->where($table_name . '.sistole', 'like', '%' . $search . '%')
                                        ->orWhere($table_name . '.diastole', 'like', '%' . $search . '%');
                                } else if ($table_name == 'mcu_nutrisi' || $table_name ==  'mcu_urine' || $table_name ==  'mcu_bab' || $table_name ==  'mcu_cairan') {
                                    $q2->where($table_name . '.pagi', 'like', '%' . $search . '%')
                                        ->orWhere($table_name . '.siang', 'like', '%' . $search . '%')
                                        ->orWhere($table_name . '.sore', 'like', '%' . $search . '%');
                                } else {
                                    $q2->where($table_name . '.hasil', 'like', '%' . $search . '%');
                                }
                            });
                    }
                }
            )
            ->where(function ($q) use ($startDate, $endDate, $table_name) {
                if ($startDate != '' && $endDate != '') {
                    $q->whereDate($table_name . '.waktu', '>=',  $startDate)
                        ->whereDate($table_name . '.waktu', '<=',  $endDate);
                }
            })
            ->count();

        return $totalData;
    }
}
