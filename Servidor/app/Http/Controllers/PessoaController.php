<?php

namespace App\Http\Controllers;

use App\AcessoPermissao;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
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
         }else {
            $pessoa = DB::table('pessoas')
                ->where('visitante', '=', 0)
                ->get();
            return response()->json($pessoa, 201);
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
            $pessoa = new Pessoa();
            unset($request['id']);
            unset($request['visitante']);
            unset($request['convidado']);
            $pessoa->fill($request->all());
            $retorno = $pessoa->save();

            if ($retorno){
                return response()->json($pessoa, 201);
            }else{
                return response()->json([
                    "mensagem" => "Não foi possível cadastrar membro."
                ],404);
            }
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
            $pessoa = DB::table('pessoas')
                ->where([
                    ['id', '=', $id],
                    ['visitante', '=', 0]
                ])
                ->get();
            return response()->json($pessoa, 201);
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
            $pessoa = Pessoa::find($id);

            if (!$pessoa) {
                return response()->json([
                    'mensagem' => 'Registro não encontrado para alteração',
                ], 404);
            }

            unset($request['id']);
            $request['visitante'] = 0;

            $pessoa->fill($request->all());
            $pessoa->save();
            return response()->json($pessoa, 201);
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
            $pessoa = Pessoa::find($id);

            if (!$pessoa) {
                return response()->json([
                    'mensagem' => 'Não foi possível encontrar usuário a ser inativado',
                ], 404);
            }

            $pessoa['ativo'] = 0;

            $pessoa->save();
            if (!$pessoa) {
                return response()->json([
                    'mensagem' => 'Não foi possível inativar usuário',
                ], 404);
            }
            return response()->json($pessoa, 201);
        }
    }
}
