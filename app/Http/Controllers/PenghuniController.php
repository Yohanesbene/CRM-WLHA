<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penghuni;
use Illuminate\Http\Request;

class PenghuniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->Penghuni = new Penghuni();
        $this->genders = ['pria' => 1, 'wanita' => 2];
    }

    public function penghuni()
    {
        $data['user'] = $this->Penghuni->daftar_penghuni();
        return view('penghuni.index')->with($data);
    }

    public function tambahPenghuni()
    {
        return view('penghuni.tambah');
    }

    public function ubahPenghuni($id)
    {
        $data['penghuni'] = $this->Penghuni->detail_penghuni($id);
        return view('penghuni.ubah')->with($data);
    }

    public function prosesTambahPenghuni(Request $request)
    {
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
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required|regex:/^[0-9]+$/',
            'foto' => 'mimes:jpg,jpeg,png',
            'kontak_darurat' => 'required',
            'notelp_darurat' => 'required|regex:/^[0-9]+$/',
            'penanggung_jawab' => 'required',
            'ruang' => 'required'

        ], $message);

        if (empty($request->foto)) {
            $imagename = null;
            $request['foto'] = null;
        }else {
            $imagename = 'penghuni'.$request['id'].'.'.$request->foto->extension();
            $request->foto->move(public_path('photos'), $imagename);
        }

        $data = $request->except(['_token', 'id', 'old_foto', 'no_induk']);
        $data['foto'] = $imagename;

        $now = Carbon::now();

        $tgl_lahir = explode('-', $request['tgl_lahir']);
        $data['no_induk'] = $now->format('m').'.'.$now->format('Y').'.0'.$this->genders[$request['gender']].'.'.$tgl_lahir[2].$tgl_lahir[1].$tgl_lahir[0];
        $data['tgl_masuk'] = $now;

        $this->Penghuni->tambah($data);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function prosesUbahPenghuni(Request $request)
    {
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
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'notelp' => 'required|regex:/^[0-9]+$/',
            'foto' => 'mimes:jpg,jpeg,png',
            'kontak_darurat' => 'required',
            'notelp_darurat' => 'required|regex:/^[0-9]+$/',
            'penanggung_jawab' => 'required',
            'ruang' => 'required'

        ], $message);

        // dd($request->no_induk);
        if (empty($request->foto)) {
            $imagename = $request['old_foto'];
        }else {
            $imagename = $request->no_induk.'.'.$request->foto->extension();
            $request->foto->move(public_path('photos'), $imagename);
        }

        $data = $request->except(['_token', 'id', 'old_foto', 'no_induk']);
        $data['foto'] = $imagename;

        $this->Penghuni->simpan($request->id, $data);

        return redirect()->back()->with('success', 'Data Berhasil Disimpan');
    }

    public function detailPenghuni(Request $request)
    {
        $return = $this->Penghuni->detail_penghuni($request->id);
        return $return;
    }

    public function getEditPenghuni(Request $request)
    {
        $return = $this->Penghuni->detail_penghuni($request->id);
        return $return;
    }
}
