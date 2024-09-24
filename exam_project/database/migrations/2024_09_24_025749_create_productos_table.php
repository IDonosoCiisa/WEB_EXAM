<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique();
            $table->string('nombre');
            $table->text('descripcionCorta');
            $table->text('descripcionLarga');
            $table->string('imagen');
            $table->decimal('precioNeto', 8, 2);
            $table->decimal('precioVenta', 8, 2);
            $table->integer('stockActual');
            $table->integer('stockMinimo');
            $table->integer('stockBajo');
            $table->integer('stockAlto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
