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
        Phase::factory()->create([
            'name' => 'WishList'
        ]);
        Phase::factory()->create([
            'name' => 'Aplicado'
        ]);
        Phase::factory()->create([
            'name' => 'Entrevista Técnica'
        ]);
        Phase::factory()->create([
            'name' => 'Aceptado'
        ]);
    }
}
