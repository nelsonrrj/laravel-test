<?php

namespace Database\Seeders;

use App\Models\PhaseRecord;
use Illuminate\Database\Seeder;

class PhaseRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PhaseRecord::factory()->count(10)->create();
    }
}
