<?php

namespace App\Http\Controllers;

use App\AcessoPermissao;
use App\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitanteController extends Controller
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
            $visitante = DB::table('pessoas')
                ->where('visitante', '=', 1)
                ->get();
            return response()->json($visitante, 201);
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
            $visitante = new Pessoa();

            $request['visitante'] = 1;

            unset($request['id']);
            $visitante->fill($request->all());
            $visitante->save();

            return response()->json($visitante, 201);
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
            $visitante = DB::table('pessoas')
                ->where([
                    ['id', '=', $id],
                    ['visitante', '=', 1]
                ])
                ->get();
            return response()->json($visitante, 201);
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
            $visitante = Pessoa::find($id);

            if (!$visitante) {
                return response()->json([
                    'mensagem' => 'Registro não encontrado para alteração',
                ], 404);
            }

            unset($request['id']);

            $visitante->fill($request->all());
            $visitante->save();
            return response()->json($visitante, 201);
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
            $visitante = Pessoa::find($id);

            if (!$visitante) {
                return response()->json([
                    'mensagem' => 'Não foi possível encontrar usuário a ser inativado',
                ], 404);
            }

            $visitante['ativo'] = 0;

            $visitante->save();
            if (!$visitante) {
                return response()->json([
                    'mensagem' => 'Não foi possível inativar usuário',
                ], 404);
            }
            return response()->json($visitante, 201);
        }
    }
}
