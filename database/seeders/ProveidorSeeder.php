<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveidor;

class ProveidorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


		Proveidor::insert($proveidors);

            ['nomE'=>'Forest Pharma B.V.',
            'pais'=>'Austria' ],
            ['nomE'=>'Forest Pharma B.V.',
            'pais'=>'Austria' ],
            ['nomE'=>'Forest Pharma B.V.',
            'pais'=>'Austria' ],

            ['nomE'=>'Chichester West Sussex',
            'pais'=>'Dinamarca' ],
            ['nomE'=>'Copenhagen S',
            'pais'=>'Dinamarca' ],

            ['nomE'=>'Sanofi-Aventis France',
            'pais'=>'Francia' ],
            ['nomE'=>'Sanofi-Aventis France',
            'pais'=>'Francia' ],

            ['nomE'=>'Chichester Business Park',
            'pais'=>'Inglaterra' ],
            ['nomE'=>'Chichester Business Park',
            'pais'=>'Inglaterra' ],

            ['nomE'=>'Forest Laboratories Nederland B.V.',
            'pais'=>'Holanda' ],

            ['nomE'=>'InfectoPharm Arzneimittel',
            'pais'=>'Alemania' ],
            ['nomE'=>'InfectoPharm Arzneimittel',
            'pais'=>'Alemania' ],

			
	
		];
        Proveidor::insert($proveidors);

    }
}
