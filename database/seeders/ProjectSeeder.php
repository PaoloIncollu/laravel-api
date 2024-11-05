<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;

// Helpers
use Illuminate\Support\Facades\Schema;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::withoutForeignKeyConstraints(function() {
            Project::truncate();
        });

        for ($i = 0; $i < 20; $i ++){

            $name = fake()->sentence(3);
            $slug = str()->slug($name);

            /* Prendo una categoria casuale dal db */
            $randomTypeId = null;
            $randomType = Type::inRandomOrder()->first();
            $randomTypeId = $randomType->id;


            Project::create([

            'name'=> $name,
            'slug'=> $slug,
            'description' => fake()->paragraph(),
            'content'=> fake()->paragraph(),
            'creation_date' => fake()->dateTimeBetween('-5 years', 'now'),
            'published'=> fake()->boolean(70),
            'type_id' => $randomTypeId

            ]);

        }
    }
}
