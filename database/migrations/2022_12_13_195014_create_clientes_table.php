<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
    if (!Schema::hasTable('clientes')) {
        Schema::create('clientes', function (Blueprint $table) {
          $table->id();
          $table->string('nome');
          $table->string('cpf');
          $table->string('sexo');
          $table->string('endereco');
          $table->string('estado');
          $table->string('cidade');
          $table->timestamp('data_nascimento')->nullable();
        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
