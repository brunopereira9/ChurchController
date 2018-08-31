<?php

use Illuminate\Database\Seeder;

class PessoasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pessoas')->insert([
            'ativo'=>1,
            'nome_completo'=>'GILBERTO BRUNO DA CRUZ PEREIRA',
            'nome_fantasia'=>'BRUNO PEREIRA',
            'telefone'=>'6730430002',
            'celular'=>'67991085386',
            'logradouro_endereco'=>'RUA PALESTINA',
            'logradouro_numero'=>'1154',
            'logradouro_cep'=>'79113330',
            'logradouro_bairro'=>'JD Panamá',
            'logradouro_complemento'=>'CASA',
            'visitante'=>0,
            'social_facebook'=>'bruno pereira',
            'social_instagram'=>'brunopereira9'
        ]);

    }
}
