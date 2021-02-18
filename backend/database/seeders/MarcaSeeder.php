<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marcas')->insert(
            [
                ['descricao' => 'Chevrolet'],
                ['descricao' => 'Ford'],
                ['descricao' => 'Hyundai'],
                ['descricao' => 'Fiat'],
                ['descricao' => 'VW'],
                ['descricao' => 'BMW'],
                ['descricao' => 'Mercedes'],
                ['descricao' => 'Honda'],
                ['descricao' => 'Audi'],
                ['descricao' => 'Toyota']
            ]
        );
    }
}
