<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setores = [
            ['nome' => 'T.I', 'descricao' => 'Tecnologia da Informação'],
            ['nome' => 'Diretoria', 'descricao' => 'Diretoria e Gestão'],
            ['nome' => 'Criação', 'descricao' => 'Equipe de Criação e Design'],
            ['nome' => 'Assessoria', 'descricao' => 'Assessoria de Imprensa e Comunicação'],
            ['nome' => 'Tráfego Pago', 'descricao' => 'Gestão de Campanhas e Anúncios'],
            ['nome' => 'Financeiro', 'descricao' => 'Administração Financeira'],
            ['nome' => 'TeleVendas', 'descricao' => 'Equipe de Vendas por Telefone'],
            ['nome' => 'Vendas', 'descricao' => 'Equipe de Vendas'],
            ['nome' => 'Vagas', 'descricao' => 'Equipe de Vagas'],
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