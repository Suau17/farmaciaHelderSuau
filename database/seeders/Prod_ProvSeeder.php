<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        DB::table('Prod_Prov')->insert([
            'proveidor_id' => 1 ,
            'producte_id' => 1
                   
        ]);
    }
}
