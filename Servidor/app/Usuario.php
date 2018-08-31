<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'id',
        'ativo',
        'id_cadastro',
        'login',
        'senha',
        'token'
    ];

    protected $hidden = [
        'senha',
    ];
}
