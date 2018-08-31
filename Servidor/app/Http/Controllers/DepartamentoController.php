<?php

namespace App\Http\Controllers;

use App\AcessoPermissao;
use App\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
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
            $departamento = Departamento::all();
            if (count($departamento)>0)
                return response()->json($departamento, 201);
            else{
                return response()->json([
                    "mensagem" => "Nenhum departamento encontrado."
                ],404);
            }
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
            $departamento = new Departamento();

            unset($request['id']);

            $departamento->fill($request->all());
            $departamento->save();

            return response()->json($departamento, 201);
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
            $departamento = Departamento::find($id);
            if ($departamento)
                return response()->json($departamento, 201);
            else{
                return response()->json([
                    "mensagem" => "Nenhum departamento encontrado."
                ],404);
            }
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
            $departamento = Departamento::find($id);

            if (!$departamento) {
                return response()->json([
                    'mensagem' => 'Registro não encontrado para alteração',
                ], 404);
            }

            unset($request['id']);

            $departamento->fill($request->all());
            $departamento->save();
            return response()->json($departamento, 201);
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
            $departamento = Departamento::find($id);

            if (!$departamento) {
                return response()->json([
                    'mensagem' => 'Não foi possível encontrar usuário a ser inativado',
                ], 404);
            }

            $departamento['ativo'] = 0;

            $departamento->save();
            if (!$departamento) {
                return response()->json([
                    'mensagem' => 'Não foi possível inativar usuário',
                ], 404);
            }
            return response()->json($departamento, 201);
        }
    }
}
