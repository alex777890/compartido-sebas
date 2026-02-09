<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('codigo')->unique();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->enum('estado', ['activo', 'inactivo', 'finalizado'])->default('inactivo');
            $table->boolean('subida_habilitada')->default(false);
            $table->timestamps();
        });

        Schema::table('documentos_maestros', function (Blueprint $table) {
            $table->foreignId('periodo_id')->nullable()->constrained('periodos');
        });
    }

    public function down()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->dropForeign(['periodo_id']);
            $table->dropColumn('periodo_id');
        });
        
        Schema::dropIfExists('periodos');
    }
};