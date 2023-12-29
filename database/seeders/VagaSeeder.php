<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VagaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['numero' => 1, 'ocupada' => false],
            ['numero' => 2, 'ocupada' => false],
            ['numero' => 3, 'ocupada' => false],
            ['numero' => 4, 'ocupada' => false],
            ['numero' => 5, 'ocupada' => false],
            ['numero' => 6, 'ocupada' => false],
            ['numero' => 7, 'ocupada' => false],
        ];

        DB::table('vaga')->insert($data);
    }
}
