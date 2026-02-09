<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grados_academicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maestro_id')->constrained()->onDelete('cascade');
            $table->enum('nivel', ['Licenciatura', 'Especialidad', 'Maestría', 'Doctorado']);
            $table->string('nombre_titulo', 200);
            $table->string('cedula_profesional', 20)->nullable();
            $table->date('fecha_expedicion_cedula')->nullable();
            $table->string('institucion', 150)->nullable();
            $table->year('ano_obtencion')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('documento')->nullable(); // Nuevo campo para el archivo
            $table->string('nombre_documento')->nullable(); // Nombre original del archivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grados_academicos');
    }
};