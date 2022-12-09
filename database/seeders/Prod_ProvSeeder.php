<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Prod_ProvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('prod_prov')->insert([
            'proveidor_id' => 1 ,
            'producte_id' => 2,
                   
        ]);
        DB::table('prod_prov')->insert([
            'proveidor_id' => 2 ,
            'producte_id' => 3,
                   
        ]);
        DB::table('prod_prov')->insert([
            'proveidor_id' => 4 ,
            'producte_id' => 5,
                   
        ]);

        DB::table('prod_prov')->insert([
            'proveidor_id' => 6 ,
            'producte_id' => 7,
                   
        ]);

        DB::table('prod_prov')->insert([
            'proveidor_id' => 8 ,
            'producte_id' => 9,
                   
        ]);
        DB::table('prod_prov')->insert([
            'proveidor_id' => 2 ,
            'producte_id' => 1,
                   
        ]);
    }
}
