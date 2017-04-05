<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalizaEscolhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finaliza_escolhas', function (Blueprint $table){
            $table->increments('id');
            $table->integer('id_user');
            $table->string('escolha_aluno',20);
            $table->string('tipo_monitoria',32);
            $table->boolen('concordatermos');
            $table->integer('id_monitoria');
            $table->boolen('finaliza_escolhas');
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
        Schema::drop('finaliza_escolhas');
    }
}
