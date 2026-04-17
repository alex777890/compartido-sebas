<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documentos_administrativos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('administrativo_id');
            $table->unsignedBigInteger('periodo_id')->nullable();
            $table->string('tipo'); 
            $table->string('nombre_archivo');
            $table->string('ruta_archivo');
            $table->string('mime_type');
            $table->integer('tamanio');
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->text('observaciones_admin')->nullable();
            $table->unsignedBigInteger('revisado_por')->nullable();
            $table->timestamp('fecha_revision')->nullable();
            $table->timestamps();

            $table->foreign('administrativo_id')->references('id')->on('administrativos')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('set null');
            $table->foreign('revisado_por')->references('id')->on('users')->onDelete('set null');
            
            // 👇 ÍNDICE CORREGIDO - nombre más corto
            $table->index(['administrativo_id', 'tipo', 'periodo_id'], 'docs_admin_tipo_periodo_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_administrativos');
    }
};