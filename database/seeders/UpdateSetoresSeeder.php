<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateSetoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setores = [
            ['nome' => 'R.H', 'descricao' => 'Recursos Humanos'],
        ];

        foreach ($setores as $setor) {
            DB::table('setores')->insert([
                'nome' => $setor['nome'],
                'descricao' => $setor['descricao'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}