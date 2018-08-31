<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'pessoas';
    protected $fillable = [
        'id',
        'ativo',
        'nome_completo',
        'nome_fantasia',
        'telefone',
        'celular',
        'rg',
        'cpf',
        'data_nascimento',
        'data_novo_nascimento',
        'membro_desde',
        'logradouro_endereco',
        'logradouro_numero',
        'logradouro_cep',
        'logradouro_complemento',
        //visitante
        'visitante',
        'data_visita',
        'convidado',
        'pessoa_convidou',
        'detalhe_visita',
        'social_twitter',
        'social_facebook',
        'social_instagram'
    ];
}
