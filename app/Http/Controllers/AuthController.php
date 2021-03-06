<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        $message = ['required' => 'Harap isi :attribute'];
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ],$message);

        $login = User::where('username', $username)->get();

        if(session()->has('auth_wlha')){
            session()->forget('auth_wlha');
        }
        if(count($login) == 0){
            return redirect('/')->with('login_error', 'Maaf username tidak ditemukan');
        } else if(Hash::check($password, $login->pluck('password')[0])){
            session()->put('auth_wlha', $login);
            if($login->pluck('id_level')[0] == 1){
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        } else if(!Hash::check($password, $login->pluck('password')[0])){
            $request->flashExcept('password');
            return redirect('/')
            ->with('login_error', 'Maaf password salah');
        } else return redirect('/');
    }

    public function logout(){
        session()->forget('auth_wlha');
        return redirect('/');
    }

    public function error($id, $urls){
        $urls = str_replace('--', '/', $urls);
        if($id == 1){
            return redirect('/')->with('auth_error', 'Anda belum login');
        } else if($id == 2){ //force logout
            session()->forget('auth_wlha');
            return redirect('/')->with('auth_error', 'Password Anda baru saja berubah, Harap login kembali');
        } else{
            return redirect($urls)->with('auth_error', 'Maaf halaman tersebut tidak diperuntukkan role anda');
        }
    }
}
