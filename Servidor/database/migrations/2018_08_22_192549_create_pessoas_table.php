<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->integer('id',1);

            $table->boolean('ativo')->default(1);
            $table->string('nome_completo',200);
            $table->string('nome_fantasia',200)->nullable();
            $table->string('telefone',20)->nullable();
            $table->string('celular',20)->nullable();
            $table->string('rg',20)->nullable();
            $table->string('cpf',20)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->date('data_novo_nascimento')->nullable();
            $table->date('membro_desde')->nullable();
            $table->string('logradouro_endereco',200)->nullable();
            $table->string('logradouro_numero',10)->nullable();
            $table->string('logradouro_cep',20)->nullable();
            $table->string('logradouro_bairro',200)->nullable();
            $table->string('logradouro_complemento',200)->nullable();
            $table->enum('rhema',[0,1,2,3])->default(0)->comment('0 = Não fez; 1 = Primeiro ano; 2 = Segundo ano; 3 = Formado');
            $table->string('social_twitter',50)->nullable();
            $table->string('social_facebook',50)->nullable();
            $table->string('social_instagram',50)->nullable();
            //visitante
            $table->date('data_visita')->nullable();
            $table->boolean('visitante')->default(0);
            $table->boolean('convidado')->default(0);
            $table->string('pessoa_convidou',200)->nullable();
            $table->string('detalhe_visita',250)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
