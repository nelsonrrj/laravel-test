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
        Application::create([
            [
                'name' => 'Back-end developer',
                'company' => 'Talently',
                'phase_id' => 1
            ],
            [
                'name' => 'Front-end developer',
                'company' => 'Talently',
                'phase_id' => 1
            ]
        ]);
    }
}
