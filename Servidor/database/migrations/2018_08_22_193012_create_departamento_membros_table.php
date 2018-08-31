<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentoMembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento_membros', function (Blueprint $table) {
            $table->integer('id',1);
            $table->integer('id_departamento');
            $table->integer('id_cadastro');
            $table->boolean('lider')->default(0);

            $table->foreign('id_cadastro')
                ->references('id')->on('pessoas')
                ->onDelete('cascade');

            $table->foreign('id_departamento')
                ->references('id')->on('departamentos')
                ->onDelete('cascade');

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
        Schema::dropIfExists('departamento_membros');
    }
}
