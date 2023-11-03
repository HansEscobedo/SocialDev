<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Llenar la tabla Area_skills
        DB::table('area_skills')->insert([
            ['name' => 'Desarrollo web'],
            ['name' => 'Desarrollo móvil'],
        ]);

        // Llenar la tabla Soft_skills
        DB::table('soft_skills')->insert([
            ['name' => 'Comunicación'],
            ['name' => 'Trabajo en equipo'],
        ]);

        // Llenar la tabla Programming_languages
        DB::table('programming_languages')->insert([
            ['name' => 'PHP'],
            ['name' => 'Java'],
        ]);
    }
}
