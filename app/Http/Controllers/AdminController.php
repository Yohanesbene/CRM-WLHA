<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role_user;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->User = new User();
    }
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function tambahPegawai(Request $request){
        $role = Role_user::orderBy('id', 'DESC')->get();

        return view('admin.tambahPegawai', compact('role'));
    }

    public function prosesTambahPegawai(Request $request){
        $message = [
            'required' => 'Harap isi :attribute',
            'same' => ':attribute tidak sesuai dengan :other',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute minimal :max karakter',
            'integer' => ':attribute hanya boleh karakter angka saja',
            'date' => ':attribute tidak valid',
            'nik.regex' => ':attribute hanya boleh angka saja'
        ];
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'id_level' => 'required',
            'nama' => 'required',
            'nik' => 'required|regex:/^[0-9]+$/',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required',
            'mulaimasuk' => 'required|date',
            'ijazah' => 'required',
            'title' => 'required',
            // 'status_kepegawaian' => 'required',
            // 'pelatihan' => 'required',
        ],$message);

        if(empty($request->foto)){
            $request['foto'] = null;
        }

        if(empty($request->status_kepegawaian)){
            $request['status_kepegawaian'] = null;
        }

        if(empty($request->pelatihan)){
            $request['pelatihan'] = null;
        }

        $error_tambah = $this->User->tambah($request);
        if($error_tambah == null){
            $request->flash();
            return redirect()->back()->with($error_tambah);
        } else {
            $message_success = ['message_success' => ['Data Pegawai Berhasil ditambahkan']];
            return redirect('/admin/dashboard')->with($message_success);
        }
    }
}
