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
        $proveidors = [
            ['nom'=>'Johnson & Johnson'],
			['nom'=>'Sanitas'],
			['nom'=>'Babaria'],
		];

		Proveidor::insert($proveidors);
    }
}
