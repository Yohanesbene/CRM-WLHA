<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (Schema::hasTable('tb_obat')) {
            DB::table('tb_obat')->truncate();
        }

        $kode_1 = ['D', 'G'];
        $kode_2 = ['B', 'T', 'K', 'P', 'N'];
        $kode_3 = ['L', 'I'];
        $kode_4 = ['01', '02', '03', '04', '05'];
        $kode_7 = ['01', '23', '43', '02', '24', '44', '04', '28', '09', '29', '46', '10', '30', '47', '11', '31', '48', '12', '32', '49', '14', '33', '53', '34', '56', '15', '36', '58', '16', '37', '62', '17', '38', '63', '22', '41', '81'];
        $kode_8 = ['A', 'B', 'C'];
        $kode_9 = [1, 2, 3];

        $data = array(
            ['namaobat' => 'Acarbose 100mg'],
            ['namaobat' => 'Acarbose 100mg'],
            ['namaobat' => 'Acarbose 50mg'],
            ['namaobat' => 'Aciclovir'],
            ['namaobat' => 'Aldomer/donepezil 5 mg'],
            ['namaobat' => 'Allopurinol 100mg'],
            ['namaobat' => 'Allopurinol 150mg'],
            ['namaobat' => 'Allopurinol 300mg'],
            ['namaobat' => 'Alprazolam 0,25mg'],
            ['namaobat' => 'Alprazolam 0,5mg'],
            ['namaobat' => 'Alprazolam 1mg'],
            ['namaobat' => 'Amlodipin 10mg	'],
            ['namaobat' => 'Amlodipin 5mg'],
            ['namaobat' => 'Amoxicilin 500mg'],
            ['namaobat' => 'Aprovel 150 mg'],
            ['namaobat' => 'Aprovel 300 mg'],
            ['namaobat' => 'Asam mefenamat'],
            ['namaobat' => 'Asthin Force'],
            ['namaobat' => 'Atorvastatin 20mg'],
            ['namaobat' => 'Atorvastatin 40mg'],
            ['namaobat' => 'Avelox'],
            ['namaobat' => 'Benoson Salp'],
            ['namaobat' => 'Bioplacenton'],
            ['namaobat' => 'Biosanbe'],
            ['namaobat' => 'Bisoprolol 2,5mg'],
            ['namaobat' => 'Bisoprolol 5mg'],
            ['namaobat' => 'Buscopan'],
            ['namaobat' => 'Calcium Lactat'],
            ['namaobat' => 'Captopril 25mg'],
            ['namaobat' => 'Captopril 50mg'],
            ['namaobat' => 'Cataflam 25mg'],
            ['namaobat' => 'Cataflam 50mg'],
            ['namaobat' => 'Cedocard 5mg'],
            ['namaobat' => 'Cendolyters'],
            ['namaobat' => 'Cetirizine 10mg'],
            ['namaobat' => 'Ciprofloxacin'],
            ['namaobat' => 'Citicolin 500mg'],
            ['namaobat' => 'Clonidin 0,15mg'],
            ['namaobat' => 'Clopidogrel 75mg'],
            ['namaobat' => 'Colinpha'],
            ['namaobat' => 'Concor 2,5mg'],
            ['namaobat' => 'Concor 5mg'],
            ['namaobat' => 'Condesartan 16mg'],
            ['namaobat' => 'Condesartan 8mg'],
            ['namaobat' => 'Counterpain'],
            ['namaobat' => 'Curcuma'],
            ['namaobat' => 'Decolgen'],
            ['namaobat' => 'Demacolin'],
            ['namaobat' => 'Depokate'],
            ['namaobat' => 'Diatap'],
            ['namaobat' => 'Digoxin 0,25mg'],
            ['namaobat' => 'Disflatyl'],
            ['namaobat' => 'Dolo Neurobion'],
            ['namaobat' => 'Donperidone'],
            ['namaobat' => 'Dulcolac'],
            ['namaobat' => 'Farmasal 100mg'],
            ['namaobat' => 'Fenofibrate 300mg'],
            ['namaobat' => 'Furosemide 20mg'],
            ['namaobat' => 'Furosemide 40mg'],
            ['namaobat' => 'Gabapentin'],
            ['namaobat' => 'GCM'],
            ['namaobat' => 'Gentamycin Salp'],
            ['namaobat' => 'Geriavita'],
            ['namaobat' => 'Glimiperide 1mg'],
            ['namaobat' => 'Glimiperide 2mg'],
            ['namaobat' => 'Glucosamine 500mg'],
            ['namaobat' => 'Herbeser 100 mg'],
            ['namaobat' => 'Ibuprofen 400mg'],
            ['namaobat' => 'Ikaphen/Phenitoin'],
            ['namaobat' => 'Insulin lantus'],
            ['namaobat' => 'Insulin novorapid'],
            ['namaobat' => 'Intracid'],
            ['namaobat' => 'Irbesartan 150mg'],
            ['namaobat' => 'Irbesartan 300mg'],
            ['namaobat' => 'Januvia 100mg'],
            ['namaobat' => 'Kalnex'],
            ['namaobat' => 'Kloderma'],
            ['namaobat' => 'Lactulal'],
            ['namaobat' => 'Lansoprazole'],
            ['namaobat' => 'Lapifed'],
            ['namaobat' => 'Lexahist 4mg/Pronicy'],
            ['namaobat' => 'Licokalk'],
            ['namaobat' => 'Limpanthyl 160mg'],
            ['namaobat' => 'Mecobalamine'],
            ['namaobat' => 'Meloxicom'],
            ['namaobat' => 'Metamizole 500mg'],
            ['namaobat' => 'Metformin 500mg'],
            ['namaobat' => 'Metoclopramid'],
            ['namaobat' => 'Miniaspi'],
            ['namaobat' => 'Motilium 10mg'],
            ['namaobat' => 'Naletat'],
            ['namaobat' => 'Naturaksi 4mg'],
            ['namaobat' => 'Nebacitin'],
            ['namaobat' => 'Neuralgin'],
            ['namaobat' => 'Neurobion Pink'],
            ['namaobat' => 'Neurobion putih'],
            ['namaobat' => 'Nexium 20mg'],
            ['namaobat' => 'Nexium 40mg'],
            ['namaobat' => 'Notisil 2 mg'],
            ['namaobat' => 'OBH'],
            ['namaobat' => 'Omega 3'],
            ['namaobat' => 'Ondonsentron'],
            ['namaobat' => 'Paracetamol 250mg'],
            ['namaobat' => 'Paracetamol 500mg'],
            ['namaobat' => 'Panadol'],
            ['namaobat' => 'Pionix'],
            ['namaobat' => 'Ramipil 2,5gr'],
            ['namaobat' => 'Ramipil 5gr'],
            ['namaobat' => 'Ranitidin'],
            ['namaobat' => 'Rovastar 20mg'],
            ['namaobat' => 'Salbutamol 2 mg'],
            ['namaobat' => 'Serolin 20 mg'],
            ['namaobat' => 'Simvastatin 10mg'],
            ['namaobat' => 'Simvastatin 20mg'],
            ['namaobat' => 'Spironolakton 25 mg'],
            ['namaobat' => 'Stelosi 1/2 tb'],
            ['namaobat' => 'Stesolid'],
            ['namaobat' => 'Strovac'],
            ['namaobat' => 'Sucralfate'],
            ['namaobat' => 'Tes Asam Urat'],
            ['namaobat' => 'Tes Cholestrol'],
            ['namaobat' => 'Tes GDS'],
            ['namaobat' => 'Trombophop 105 Gitas'],
            ['namaobat' => 'Urinter'],
            ['namaobat' => 'Valisanbe'],
            ['namaobat' => 'V-Block'],
            ['namaobat' => 'VH B Complex'],
            ['namaobat' => 'VH C'],
            ['namaobat' => 'VIP Albumin'],
            ['namaobat' => 'Vit B1'],
            ['namaobat' => 'Vit B12'],
            ['namaobat' => 'Vit B6'],
            ['namaobat' => 'Voltadex'],
            ['namaobat' => 'Xepacym'],
            ['namaobat' => 'Zinc']
        );


        for ($i = 0; $i < count($data); $i++) {
            $k1 = Arr::random($kode_1, 1)[0];
            $k2 = Arr::random($kode_2, 1)[0];
            $k3 = Arr::random($kode_3, 1)[0];
            $k4 = Arr::random($kode_4, 1)[0];
            $k5 = 100 + $i;
            $k6 = 100 + $i;
            $k7 = Arr::random($kode_7, 1)[0];
            $k8 = Arr::random($kode_8, 1)[0];
            $k9 = Arr::random($kode_9, 1)[0];

            for ($j = 1; $j < 10; $j++) {
                $data[$i]['kode_' . $j] = ${'k' . $j};
            }
            $data[$i]['kode_slug'] = "$k1$k2$k3$k4$k5$k6$k7$k8$k9";
        }

        // print_r($data);
        DB::table('tb_obat')->insert($data);
    }
}
