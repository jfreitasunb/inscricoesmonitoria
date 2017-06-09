<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosPessoaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados_pessoais', function (Blueprint $table){
            $table->increments('id');
            $table->integer('id_user');
            $table->string('nome');
            $table->string('numerorg',20);
            $table->string('emissorrg',200);
            $table->string('cpf',11);
            $table->string('endereco',255);
            $table->string('cidade',100);
            $table->string('cep',11);
            $table->string('estado',3);
            $table->string('telefone',20);
            $table->string('celular',20);
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
        Schema::drop('dados_pessoais');
    }
}
