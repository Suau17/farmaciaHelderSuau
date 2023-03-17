<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producte;

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
            [
                'nom' => 'Colistin Forest ',
                'tipus' => 'ingerir',
                'preu' => 3,
                'stock' => '22'
            ],
            [
                'nom' => 'Colistin Xellia',
                'tipus' => 'vía inhalatoria',
                'preu' => 10,
                'stock' => '22'
            ],
            [
                'nom' => 'ColiFin',
                'tipus' => 'vía inhalatoria',
                'preu' => 10,
                'stock' => '22'
            ],

            [
                'nom' => 'Promixin',
                'tipus' => 'vía inhalatoria',
                'preu' => 3,
                'stock' => '22'
            ],

            [
                'nom' => 'TADIM ',
                'tipus' => 'COLIMICINA',
                'preu' => 14,
                'stock' => '22'
            ],
            [
                'nom' => 'Colistin Xellia',
                'tipus' => 'vía intravenosa',
                'preu' => 10,
                'stock' => '22'
            ],
            [
                'nom' => 'COLFINAIR ',
                'tipus' => 'vía inhalatoria',
                'preu' => 8,
                'stock' => '22'
            ],
            [
                'nom' => 'Colistin TZF',
                'tipus' => 'vía intrmuscular',
                'preu' => 6,
                'stock' => '22'
            ],
            [
                'nom' => 'KOLOMYCÍN',
                'tipus' => 'vía inhalatoria',
                'preu' => 4,
                'stock' => '22'
            ],
            [
                'nom' => 'Colixin ',
                'tipus' => 'vía inhalatoria',
                'preu' => 10,
                'stock' => '22'
            ],
            [
                'nom' => 'ibuprofeno',
                'tipus' => 'ingerir',
                'preu' => 3,
                'stock' => '22'
            ],


        ];
        Producte::insert($productes);
    }
}
