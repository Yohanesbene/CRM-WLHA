<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsuhanKeperawatanController extends Controller
{
    public function __construct()
    {
        $this->User = new User();
        $this->Penghuni = new Penghuni();
    }

    public function penghuni()
    {
        // $data['user'] = $this->Penghuni->daftar_penghuni();
        return view('askep.index');
    }

    public function data_penghuni(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'nama',
            2 => 'tgl_lahir',
            3 => 'ruang',
            4 => 'status',
            5 => 'action'
        );

        $totalData = Penghuni::count();
        $totalFiltered = $totalData;
        $limit = $request->input('length');

        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $penghuni = $this->Penghuni->daftar_penghuni('', $start, $limit, $order, $dir);
        }
        else
        {
            $search = $request->input('search.value');
            $penghuni = $this->Penghuni->daftar_penghuni($search, $start, $limit, $order, $dir);
        }
        $data = array();

        foreach ($penghuni as $key => $p) {
            $row['id'] = $start+$key+1;
            $row['nama'] = $p->nama;
            $row['ruang'] = $p->ruang;
            $row['status'] = $p->meninggal == 0 || $p->keluar == 0 ?
                    '<span class="bg-green-200 text-green-700 font-semibold py-1 px-3 rounded-full text-sm">Active</span>' :
                    '<span class="bg-red-200 text-red-700 font-semibold py-1 px-3 rounded-full text-sm">Inactive</span>';
            $row['action'] =
                    '<a href="'. route('rekmed.detail', ['id' => $p->id]) .'" class="flex flex-nowrap items-center text-indigo-400 font-medium text-lg hover:text-indigo-900 transition duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg> <p class="pl-3">Asuhan Keperawatan</p>
                    </a>';
            $data[] = $row;
        }

        $json_data = array(
        "draw"            => intval($request->input('draw')),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "data"            => $data
        );

        echo json_encode($json_data);
    }
}
