<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producte;
use App\Models\Proveidor;

class ProducteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productes = [
            ['nom'=>'Accelerated Healing',
            'tipus'=>'ibuprofeno'],
            ['nom'=>'Accelerated Healing',
            'tipus'=>'ibuprofeno'],
            ['nom'=>'Accelerated Healing',
            'tipus'=>'ibuprofeno'],

			
	
		];

		Producte::insert($productes);
    }
}
