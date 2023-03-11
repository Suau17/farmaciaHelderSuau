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
            ['nom'=>'Colistin Forest ',
            'tipus'=>'ingerir',
             'stock' => '22'],
            ['nom'=>'Colistin Xellia',
            'tipus'=>'vía inhalatoria',
            'stock' => '22'],
            ['nom'=>'ColiFin',
            'tipus'=>'vía inhalatoria',
            'stock' => '22'],

            ['nom'=>'Promixin',
            'tipus'=>'vía inhalatoria',
            'stock' => '22'],

            ['nom'=>'TADIM ',
            'tipus'=>'COLIMICINA',
            'stock' => '22'], 
            ['nom'=>'Colistin Xellia',
            'tipus'=>'vía intravenosa'],
            ['nom'=>'COLFINAIR ',
            'tipus'=>'vía inhalatoria'], 
            ['nom'=>'Colistin TZF',
            'tipus'=>'vía intrmuscular'],
            ['nom'=>'KOLOMYCÍN',
            'tipus'=>'vía inhalatoria'], 
            ['nom'=>'Colixin ',
            'tipus'=>'vía inhalatoria'],
            ['nom'=>'ibuprofeno',
            'tipus'=>'ingerir'],

			
        ];
        Producte::insert($productes);
    }
}
