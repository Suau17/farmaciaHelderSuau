<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveidor;
use App\Models\Producte;


class ProveidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proveidors = [
            ['nomE'=>'Accelerated Healing',
            'pais'=>'españa' ],

            ['nomE'=>'Accelerated Healing',
            'pais'=>'españa' ],
            ['nomE'=>'Accelerated Healing',
            'pais'=>'españa' ],

			
	
		];

		Proveidor::insert($proveidors);

    }
}
