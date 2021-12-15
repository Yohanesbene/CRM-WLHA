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
        $this->Role_User = new Role_User();
    }
    public function kepegawaian(){
        $return =  [
            'role' => $this->Role_User->get_role(),
            'user' => $this->User->get_user()
        ];

        return view('admin.kepegawaian')->with($return);
    }

    public function kepegawaianredirect(){
        return redirect('kepegawaian/');
    }

    public function tambahPegawai(Request $request){
        $role =  ['role' => $this->Role_User->get_role()];
        return view('admin.tambahPegawai')->with($role);
    }

    public function prosesTambahPegawai(Request $request){
        // return $request->foto->getClientOriginalExtension();
        $message = [
            'required' => 'Harap isi :attribute',
            'same' => ':other tidak sesuai dengan :attribute',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute minimal :max karakter',
            'integer' => ':attribute hanya boleh karakter angka saja',
            'date' => ':attribute tidak valid',
            'nik.regex' => ':attribute hanya boleh angka saja',
            'mimes' => ':attribute hanya bole jpg, jpeg atau png'

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
            'status_kepegawaian' => 'required',
            'pelatihan' => 'required',
            'foto' => 'required|mimes:jpg,jpeg,png'

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
        if($error_tambah['error_tambah'] != null){
            $role =  ['role' => $this->Role_User->get_role()];
            $request->flash();
            return redirect()->back()->with($error_tambah,$role);
        } else {
            $message_success = ['message_success' => ['Data Pegawai Berhasil ditambahkan']];

            return redirect('/admin/kepegawaian')->with($message_success);
        }

        // return $extension;
    }

    public function ubahpassword(){
        $username = ['username' => $this->User->get_ganti_password()];
        return view('admin.ubahpassword')->with($username);
    }

    public function prosesUbahPassword(Request $request){
        $message = [
            'required' => 'Harap isi :attribute',
            'same' => ':other tidak sesuai dengan :attribute',
            'min' => ':attribute minimal :min karakter',
        ];
        $this->validate($request, [
            'id' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ],$message);

        $error_ubahpassword =$this->User->ganti_password($request);

        if($error_ubahpassword['error_ubahpassword'] != null){
            $username = ['username' => $this->User->get_ganti_password()];
            $request->flash();
            return redirect()->back()->with($error_ubahpassword, $username);
        } else {
            $u = session()->get('auth_wlha.0')->username;
            $i = session()->get('auth_wlha.0')->id;

            if($u == $request->id_atau_username){
                // return redirect('/auth/logout');
                return redirect('/login/error/2/null--');
            } else if($i == $request->id_atau_username){
                // return redirect('/auth/logout');
                return redirect('/login/error/2/null--');
            }
            else {
                $message_success = ['message_success' => ['Password Berhasil ditambahkan']];
                return redirect('/admin/kepegawaian')->with($message_success);
            }
        }
    }

    public function detail(Request $request){
        $return =
            $this->User->get_detail($request->id);
        return $return;
    }

    public function getEdit(Request $request){

        $return =  [
            'role' => $this->Role_User->get_role(),
            'user' => $this->User->get_detail($request->id)
        ];
        return $return;
    }

    public function prosesEdit(Request $request){
        $update =$this->User->edit($request);
        return $update;
    }
}
//Penghuni : id, nama, penanggunajawab, kamar
