
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('maestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coordinaciones_id')->constrained()->onDelete('cascade');
            $table->string('nombres', 100);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50)->nullable();
            $table->enum('maximo_grado_academico', ['Licenciatura', 'Especialidad', 'Maestría', 'Doctorado']);
            $table->year('anio_ingreso')->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('edad')->nullable(); // CAMPO AGREGADO
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro'])->nullable();
            $table->enum('estado_civil', ['Soltero', 'Casado', 'Divorciado', 'Viudo', 'Unión Libre'])->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('email', 100)->unique();
            $table->text('direccion')->nullable();
            $table->string('rfc', 13)->unique();
            $table->string('curp', 18)->unique();
            $table->boolean('activo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maestros');
    }
};