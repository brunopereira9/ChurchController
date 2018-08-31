<?php

namespace App\Http\Controllers;

use App\AcessoPermissao;
use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $valida = new AcessoPermissao();
        $login = $valida->verificaLogin();

        if(!$login){
            return response()->json([
                "mensagem" => "Usuário sem permissão de acesso."
            ],401);
        }else{
            $usuario =  Usuario::all();

            return response()->json($usuario,201);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $valida = new AcessoPermissao();
        $login = $valida->verificaLogin();

        if(!$login){
            return response()->json([
                "mensagem" => "Usuário sem permissão de acesso."
            ],401);
        }else {
            $usuario = new Usuario();
            $acessoPermicao = new AcessoPermissao();

            unset($request['id']);//não retirar, para não ser possível fazer modificação nem criação de id errado

            $usuario->fill($request->all());
            $usuario['token'] = $acessoPermicao->geraToken($usuario['id'], $usuario['login']);
            $usuario->save();

            if (!$usuario) {
                return response()->json([
                    'mensagem' => 'Não foi possível criar novo usuário',
                ], 404);
            }
            return response()->json($usuario, 201);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $valida = new AcessoPermissao();
        $login = $valida->verificaLogin();

        if(!$login){
            return response()->json([
                "mensagem" => "Usuário sem permissão de acesso."
            ],401);
        }else {
            $usuario = Usuario::find($id);
            if (!$usuario) {
                return response()->json([
                    'mensagem' => 'Registro não encontrado',
                ], 404);
            }

            return response()->json($usuario, 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $valida = new AcessoPermissao();
        $login = $valida->verificaLogin();

        if(!$login){
            return response()->json([
                "mensagem" => "Usuário sem permissão de acesso."
            ],401);
        }else {
            $acessoPermicao = new AcessoPermissao();
            $usuario = Usuario::find($id);

            if (!$usuario) {
                return response()->json([
                    'mensagem' => 'Registro não encontrado para alteração',
                ], 404);
            }

            unset($request['id']);
            unset($request['token']);

            $usuario->fill($request->all());
            $usuario['token'] = $acessoPermicao->geraToken($usuario['id'], $usuario['login']);
            $usuario->save();
            return response()->json($usuario, 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $valida = new AcessoPermissao();

        $login = $valida->verificaLogin();

        if(!$login){
            return response()->json([
                "mensagem" => "Usuário sem permissão de acesso."
            ],401);
        }else {
            $usuario = Usuario::find($id);

            if (!$usuario) {
                return response()->json([
                    'mensagem' => 'Não foi possível encontrar usuário a ser inativado',
                ], 404);
            }

            $usuario['ativo'] = 0;

            $usuario->save();
            if (!$usuario) {
                return response()->json([
                    'mensagem' => 'Não foi possível inativar usuário',
                ], 404);
            }
            return response()->json($usuario, 201);
        }
    }

}
