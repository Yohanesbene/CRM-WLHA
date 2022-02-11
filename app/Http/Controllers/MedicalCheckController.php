<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use App\Models\User;
use App\Models\Role_user;

class MedicalCheckController extends Controller
{
    public class berat_badan($id){
        $data['penghuni'] = Penghuni::detail_penghuni($id);
        
    }
}
