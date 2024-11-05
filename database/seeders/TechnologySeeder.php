<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Helpers
use Illuminate\Support\Facades\Schema;


class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });

        $allTechnologies = [
            'HTML',
            'CSS',
            'Java Script',
            'Vue',
            'SQL',
            'PHP',
            'Laravel'
        ];

        foreach ($allTechnologies as $singletechnology) {
            $technology = Technology::create([
                'name' => $singletechnology,
                'slug' => str()->slug($singletechnology),
            ]);
        }
    }
}
