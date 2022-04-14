<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;
    protected $table = 'penghuni';

    public static function daftar_penghuni($query)
    {   
        $q = explode("/", $query);
        $data;
        if(count($q) == 4){
            $data = Penghuni::where('id', $q[3])
            ->paginate(10);   
        } else {
            $data = Penghuni::where('nama', 'like', "%" . $query . "%")
            ->orWhere('id', 'like', "%" . $query . "%")
            ->orWhere('nickname', 'like', "%" . $query . "%")
            ->orWhere('no_induk', 'like', "%" . $query . "%")
            ->paginate(10);
        }

        if($data->count() == 0){
            $data = Penghuni::paginate(10);
        }

        return $data;
    }

    public static function detail_penghuni($id)
    {
        $data = Penghuni::where('id', $id);
        return $data->first();
    }
}
