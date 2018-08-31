<?php

namespace App\Http\Controllers;

use App\AcessoPermissao;
use App\Criptografia;
use App\Usuario;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function create(Request $request)
    {
        //ajusta os dados de $request para sqlInject
        $request['login'] = addslashes($request['login']);
        $request['senha'] = addslashes($request['senha']);

        $cript = new Criptografia();

        $login = $cript->criptografar($request['login']);
        $senha = $cript->criptografar($request['senha']);

        //verifica se existe o login no banco de dados
        $usuario = Usuario::where("login", "=", $login)
            ->where("senha", "=", $senha)
            ->get();
        //caso exista esse usuario
        if (count($usuario) > 0){
            $usuario = $usuario[0];
            //gera um novo token
            $valida = new AcessoPermissao();
            $token = $valida->geraToken($usuario['id'],$usuario['login']);
            $usuario['remember_token'] = md5($token);
            
            $usuario->save();

            $usuario['remember_token'] = $token;
            //retorna o usuario
            return response()->json($usuario, 201);

        }

        return response()->json([
            "error"=>"Login ou senha inválidos."
        ], 404);

    }

    public function show($token){
        //verifica se o usuário é valido para finalização
        $valida = new AcessoPermissao();

        $login = $valida->verLoginGeraToken($token);

        if ($login){
            $cript = new Criptografia();
            return response()->json($login,201);
        }

        return response()->json([
            "mensagem" => "Usuário sem permissão de acesso."
        ],401);
    }

    public function destroy($token)
    {
        //verifica se o usuário é valido para finalização
        $valida = new AcessoPermissao();
        $login = $valida->verificaLogin($token);

        if($login){
            return response()->json([
                "mensagem" => "Usuário desconectado."
            ],201);
        }else{
            return response()->json([
                "mensagem" => "Usuário sem permissão de acesso."
            ],401);
        }

    }
}
