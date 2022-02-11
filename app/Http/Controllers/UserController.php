<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penghuni;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function medicalRecord(Request $request)
    {
        if($query = $request->input('query')){
            $query = $request->input('query');
            $data['query'] = $query;
            $data['page_url'] = '/user/medicalrecord?query='.$query;

            $query = str_replace(" ", "%", $query);

            $data['penghuni'] = Penghuni::daftar_penghuni($query);
            // $data['count'] = $data['penghuni']->count();

        } else {
            $data['page_url'] = '/user/medicalrecord';
            $data['penghuni'] = Penghuni::paginate(10);
        };
        return view('user.medicalrecord', $data);
    }

    public function detail_medis($id)
    {   
        $data['penghuni'] = Penghuni::detail_penghuni($id);

        foreach(['berat_badan', 'nadi', 'spo2', 'suhu_badan'] as $tb){
            $data['data'][$tb] = DB::table('mcu_'.$tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->limit(10)
                ->get();
        };

        $data['satuan']['nadi'] = ' bpm';
        $data['satuan']['berat_badan'] = ' kg';
        $data['satuan']['spo2'] = ' %';
        $data['satuan']['suhu_badan'] = ' &deg;C';

        $data['data_2']['tekanan_darah'] = DB::table('mcu_tekanan_darah')
            ->where('id_penghuni', $id)
            ->orderBy('waktu', 'desc')
            ->limit(20)
            ->get();
        $data['satuan']['tekanan_darah'] = ' mmHg';

        foreach(['makan', 'minum', 'urine', 'bab'] as $tb){
            $data['data_3'][$tb] = DB::table('mcu_'.$tb)
                ->where('id_penghuni', $id)
                ->where('deleted', 0)
                ->orderBy('waktu', 'desc')
                ->limit(20)
                ->get();
        }
        $data['satuan']['makan'] = ' Porsi';
        $data['satuan']['minum'] = ' ml';
        $data['satuan']['urine'] = '';
        $data['satuan']['bab'] = '';
        return view('user.detail_medis', $data);
    }

    public function fetch_data(Request $request)
    {
        $query = $request->input('query');
        $data['page_url'] = '/user/medicalrecord?query='.$query;
        $data['query'] = $query;

        $query = str_replace(" ", "%", $query);

        $data['penghuni'] = Penghuni::daftar_penghuni($query);

        $data['count'] = $data['penghuni']->count();

        return view('user.daftar_penghuni', $data)->render();
    }

    public function tambah_mcu($id)
    {
        $data['penghuni'] = Penghuni::detail_penghuni($id);
       
        return view('user.tambah_mcu', $data);
    }

    public function hapus_mcu($id, $data, $id_penghuni)
    {
        DB::table('mcu_'.$data)
        ->where('id', $id)
        ->update(['deleted' => 1]);

        return redirect(route('user.detail_medis', ['id' => $id_penghuni]))->with('message', 'data berhasil dihapus');
    }

    public function simpan_mcu(Request $request)
    {
        $input = $request->input();
        
        if($input['id_penghuni']){
            foreach(['berat_badan', 'nadi', 'spo2', 'suhu_badan'] as $tb){
                if($input[$tb]){
                    DB::table('mcu_'.$tb)->insert([
                        'id_pegawai' => $input['id_pegawai'],
                        'id_penghuni' => $input['id_penghuni'],
                        'hasil' => $input[$tb],
                        'waktu' => now()
                    ]);
                }
            }
        
            
            foreach(['makan', 'minum', 'urine', 'bab'] as $tb){
                foreach(['pagi', 'siang', 'sore'] as $waktu){
                    if($input[$tb."_".$waktu]){
                        DB::table("mcu_".$tb)->insert([
                            'id_pegawai' => $input['id_pegawai'],
                            'id_penghuni' => $input['id_penghuni'],
                            $waktu => $input[$tb."_".$waktu],
                            'waktu' => now()
                        ]);
                    }
                }
            }
        }

        return redirect(route('user.detail_medis', ['id' => $input['id_penghuni']]))->with('message', 'data berhasil ditambahkan');

    }

    public function hasil_rekam($data)
    {
        dd($data);
    }
}
