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
      if (!Schema::hasTable('pedidos')) {
        Schema::create('pedidos', function (Blueprint $table) {
          $table->id();
          $table->date('data');
          $table->bigInteger('id_cliente');
          $table->decimal('valor', $precision = 8, $scale = 2);
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
        Schema::dropIfExists('pedidos');
    }
};
