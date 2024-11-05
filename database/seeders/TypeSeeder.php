<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Helpers
use Illuminate\Support\Facades\Schema;

// Models

use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Type::truncate();
        });

        $allTypes = [
            'E-commerce',
            'Corporate',
            'Portfolio',
            'Blog',
            'No-Profit',
            'Educational',
            'Personal'
        ];

        foreach ($allTypes as $singletype) {
            $type = Type::create([
                'name' => $singletype,
                'slug' => str()->slug($singletype),
            ]);
        }
    }
}
