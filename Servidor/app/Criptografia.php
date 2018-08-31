<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criptografia extends Model
{
    public function criptografar($dado){
        $dado = base64_encode($dado);
        $dado = base64_encode($dado);
        return $dado;
    }

    public function descriptografar($dado){
        $dado = base64_decode($dado);
        $dado = base64_decode($dado);
        return $dado;
    }
}
