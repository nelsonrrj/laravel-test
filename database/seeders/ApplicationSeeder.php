<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Phase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Application::factory()->count(10)->create();
    }
}
