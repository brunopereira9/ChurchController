<?php

#Controlador
$login = 'd56b699830e77ba53855679cb1d252da/';
$usuario = 'f8032d5cae3de20fcec887f395ec9a6a/';
$departamento = 'f7b391b19acafeb16ba6f1e4676a617e/';
$pessoa = '5b9f3257ab6a7a150f20f7d4f228559b/';
$visitante = 'cab5a031f5506b862b7487f987edbd68/';

#Comando
$index = 'e540cdd1328b2b21e29a95405c301b9313b7c346/';
$create = '9b7c68a918b17eb053809b198d7c9abfc142f30a/';
$show = '9fb29051f2217270a7b253a39f820310d85a78f0/';
$update = '0a25ba5991316bdda4a9b3abcee2106016df28a0/';
$destroy = '6870010883a79e8b2a508909dc21a05cc8ff73b8/';

#Parametro
$token = '{token}/';

#Rotas
//login
Route::post($login.$create,'LoginController@create');
Route::get($login.$show.$token,'LoginController@show');
Route::delete($login.$destroy.$token,'LoginController@destroy');


//usuario
    Route::get($usuario.$index.$token,'UsuarioController@index');
    Route::post($usuario.$create.$token,'UsuarioController@create');
    Route::get($usuario.$show.$token.'{id}','UsuarioController@show');
    Route::put($usuario.$update.$token.'{id}','UsuarioController@update');
    Route::delete($usuario.$destroy.$token.'{id}','UsuarioController@destroy');

//departamento
    Route::get($departamento.$index.$token,'DepartamentoController@index');
    Route::post($departamento.$create.$token,'DepartamentoController@create');
    Route::get($departamento.$show.$token.'{id}','DepartamentoController@show');
    Route::put($departamento.$update.$token.'{id}','DepartamentoController@update');
    Route::delete($departamento.$destroy.$token.'{id}','DepartamentoController@destroy');

//pessoa
    Route::get($pessoa.$index.$token,'PessoaController@index');
    Route::post($pessoa.$create.$token,'PessoaController@create');
    Route::get($pessoa.$show.$token.'{id}','PessoaController@show');
    Route::put($pessoa.$update.$token.'{id}','PessoaController@update');
    Route::delete($pessoa.$destroy.$token.'{id}','PessoaController@destroy');

//visitante
    Route::get($visitante.$index.$token,'VisitanteController@index');
    Route::post($visitante.$create.$token,'VisitanteController@create');
    Route::get($visitante.$show.$token.'{id}','VisitanteController@show');
    Route::put($visitante.$update.$token.'{id}','VisitanteController@update');
    Route::delete($visitante.$destroy.$token.'{id}','VisitanteController@destroy');
