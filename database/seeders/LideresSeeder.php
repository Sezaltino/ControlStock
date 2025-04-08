<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Setor;

class LideresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array de líderes por setor
        $lideres = [
            ['nome' => 'T.I', 'email' => 'tiprime2b@gmail.com', 'setor' => 'T.I'],
            ['nome' => 'Michele Moraes', 'email' => 'michele.moraes@prime2b.digital', 'setor' => 'Diretoria'],
            ['nome' => 'Fernanda Fernandes', 'email' => 'fernanda.fernandes@prime2b.digital', 'setor' => 'Criação'],
            ['nome' => 'Maria Lara', 'email' => 'marialara.assessoria@gmail.com', 'setor' => 'Assessoria'],
            ['nome' => 'Breno Fante', 'email' => 'breno.fante@prime2b.digital', 'setor' => 'Tráfego Pago'],
            ['nome' => 'Wesley Santos', 'email' => 'financeiroprime2b02@gmail.com', 'setor' => 'Financeiro'],
            ['nome' => 'Pedro Augusto', 'email' => 'pedro.augusto@prime2b.digital', 'setor' => 'TeleVendas'],
            ['nome' => 'Gabriel Milane', 'email' => 'gabriel.milane@prime2b.digital', 'setor' => 'Vendas'],
            ['nome' => 'Carol' , 'email' => 'vagas.prime2b@gmail.com', 'setor' => 'Vagas'],
        ];

        foreach ($lideres as $lider) {
            // Encontrar o ID do setor pelo nome
            $setor = Setor::where('nome', $lider['setor'])->first();
            
            if ($setor) {
                DB::table('lideres')->insert([
                    'nome' => $lider['nome'],
                    'email' => $lider['email'],
                    'setor_id' => $setor->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}