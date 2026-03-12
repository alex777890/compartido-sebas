<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('administrativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('curp', 18)->unique();
            $table->string('rfc', 13)->unique();
            $table->string('telefono', 20);
            $table->string('email_personal', 100);
            $table->text('direccion');
            $table->string('puesto', 100);
            $table->date('fecha_ingreso');
            $table->string('numero_empleado', 50)->unique();
            $table->string('area_adscripcion', 100);
            $table->string('maximo_grado_estudios')->nullable();
            $table->string('escolaridad')->nullable();
            $table->json('documentos')->nullable(); // Para almacenar rutas de documentos
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrativos');
    }
};