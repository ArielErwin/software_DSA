<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Documentos extends Migration
{
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('nro_carta');
            $table->string('procedencia');
            $table->text('detalle')->nullable();
            $table->string('nombre_archivo');
            $table->string('repositorio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}