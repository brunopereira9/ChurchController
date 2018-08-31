<?php

use Illuminate\Database\Seeder;
use App\AcessoPermissao;
use App\Criptografia;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valida = new AcessoPermissao();
        $cript = new Criptografia();

        $id = 1;
        $ativo = 1;
        $id_cadastro = 1;
        $login = $cript->criptografar('gilberto.pereira');
        $senha = $cript->criptografar('admin');
        DB::table('usuarios')->insert([
            'id' => $id,
            'ativo' => $ativo,
            'id_cadastro' => $id_cadastro,
            'login' => $login,
            'senha' => $senha
        ]);
    }
}
