<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcessoPermissao extends Model
{
    /**
     * @param $token
     * @return array
     */
    private function descriptToken($token){
        $cript = new Criptografia();
        $chave = $cript->descriptografar($token);
        $chave = explode('|', $chave);
        //0 = id
        //1 = login
        //2 = data
        return $chave;
    }


    /**
     * @param $token
     * @return bool
     */
    public function verificaLogin($token)
    {
        $usuario = Usuario::where('remember_token','=', md5($token))->get();
        if (count($usuario) > 0){
            return true;
        }

        return false;
    }


    /**
     * @param $token
     * @return bool
     */
    public function verLoginGeraToken($token){
        $cript = new Criptografia();
        if ($this->verificaLogin($token)){
            $token = $this->descriptToken($token);

            $usuario = Usuario::find($token[0]);
            $token = $this->geraToken($token[0],$token[1]);
            $usuario->remember_token = md5($token);

            $usuario->save();

            $usuario->remember_token = $token;
            $usuario->login = $cript->descriptografar($usuario->login);

            return $usuario;

        }
        return false;
    }


    /**
     * @param $id
     * @param $login
     * @return string
     */
    public function geraToken($id, $login){

        $cript = new Criptografia();

        return $cript->criptografar($id."|".$login."|".date('Y-m-d H:i:s'));

    }
}
