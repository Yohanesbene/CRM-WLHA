<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role_user extends Model
{
    use HasFactory;
    public function get_role(){
        $role = DB::table('role_users')
        ->OrderBy('id', 'DESC')
        ->get()
        ->toArray();
        // dd($role);
        return $role;
    }
}
