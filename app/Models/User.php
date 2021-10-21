<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;
    public function tambah($data){
        $return['error_tambah'] = null;

        $check_username = DB::table('users')->where('username', $data->username)->get();
        if(count($check_username) > 0){
            $return['error_tambah']['username'] = 'Username sudah ada';
        }
        // $return['error_tambah']['password'] = $data->password;
        // $return['error_tambah']['password_confirmation'] = $data->password_confirmation;
        // $return['error_tambah']['id_level'] = $data->id_level;
        // $return['error_tambah']['nama'] = $data->nama;

        $check_nik = DB::table('users')->where('nik', $data->nik)->get();
        if(count($check_nik) > 0){
            $return['error_tambah']['nik'] = $data->nik;
        }
        // $return['error_tambah']['tgl_lahir'] = $data->tgl_lahir;
        // $return['error_tambah']['gender'] = $data->gender;
        // $return['error_tambah']['agama'] = $data->agama;
        // $return['error_tambah']['alamat'] = $data->alamat;
        // $return['error_tambah']['notelp'] = $data->notelp;
        // $return['error_tambah']['mulaimasuk'] = $data->mulaimasuk;
        // $return['error_tambah']['ijazah'] = $data->ijazah;
        // $return['error_tambah']['title'] = $data->title;
        // $return['error_tambah']['status_kepegawaian'] = $data->status_kepegawaian;
        // $return['error_tambah']['pelatihan'] = $data->pelatihan;


        if($return['error_tambah'] == null ){
            $tgl_masuk = $data->mulaimasuk;
            $tgl_masuk = str_replace('-', '', $tgl_masuk);
            // $tgl_masuk = "20211019";
            // dd(strlen($tgl_masuk));
            $role = DB::table('role_users')->where('id', $data->id_level)->get()->pluck('kode')[0];
            $check_id = DB::table('users')->where('id', 'like', $role.'%')->latest('id')->first('id');
            if($check_id == null){
                // dd($check_id);

                DB::table('users')->insert([
                    'id' => $role . '-' . $tgl_masuk . '-001',
                    'username' => $data->username,
                    'id_level' => $data->id_level,
                    'status' => 1,
                    'password' => Hash::make($data->password),
                    'nama' => $data->nama,
                    'nik' => $data->nik,
                    'foto' => $data->foto,
                    'tgl_lahir' => $data->tgl_lahir,
                    'gender' => $data->gender,
                    'agama' => $data->agama,
                    'alamat' => $data->alamat,
                    'notelp' => $data->notelp,
                    'mulaimasuk' => $data->mulaimasuk,
                    'ijazah' => $data->ijazah,
                    'title' => $data->title,
                    'status_kepegawaian' => $data->status_kepegawaian,
                    'pelatihan' => $data->pelatihan
                ]);

                return $return;
            } else {
                $last_id = DB::table('users')->where('id', 'like', $role.'%')->latest()->first();
                $last_id = substr($last_id->id, strlen($last_id->id)-3, strlen($last_id->id));
                if($last_id+1 <10) $last_id ='00' . $last_id +1;
                elseif($last_id+1 <100) $last_id ='0' . $last_id +1;
                else $last_id = $last_id+1;

                $new_id = $role.'-'. $tgl_masuk. '-'. $last_id;
                // dd($check_id, $last_id, $new_id);
                DB::table('users')->insert([
                    'id' => $new_id,
                    'username' => $data->username,
                    'id_level' => $data->id_level,
                    'status' => 1,
                    'password' => Hash::make($data->password),
                    'nama' => $data->nama,
                    'nik' => $data->nik,
                    'foto' => $data->foto,
                    'tgl_lahir' => $data->tgl_lahir,
                    'gender' => $data->gender,
                    'agama' => $data->agama,
                    'alamat' => $data->alamat,
                    'notelp' => $data->notelp,
                    'mulaimasuk' => $data->mulaimasuk,
                    'ijazah' => $data->ijazah,
                    'title' => $data->title,
                    'status_kepegawaian' => $data->status_kepegawaian,
                    'pelatihan' => $data->pelatihan
                ]);
                return $return;
            }

        }
        else{
            return $return;
        }


    }
}
