<?php

namespace Database\Seeders;

use App\Models\Phase;
use Illuminate\Database\Seeder;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Phase::create([
            'name' => 'WishList'
        ]);
        Phase::create([
            'name' => 'Aplicado'
        ]);
        Phase::create([
            'name' => 'Entrevista Técnica'
        ]);
        Phase::create([
            'name' => 'Aceptado'
        ]);
    }
}
