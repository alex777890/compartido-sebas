<?php
// database/migrations/2024_xx_xx_xxxxxx_create_documentos_maestro_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_ingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maestro_id');
            $table->unsignedBigInteger('tipo_documento_id'); // Relación con tipos_documentos
            $table->string('archivo'); // Nombre del archivo guardado
            $table->string('archivo_original'); // Nombre original del archivo
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->text('observaciones')->nullable(); // Si se rechaza, por qué
            $table->integer('version')->default(1);
            $table->boolean('proceso_activo')->default(false); // Control del admin
            $table->timestamp('fecha_subida');
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('maestro_id')
                  ->references('id')
                  ->on('maestros')
                  ->onDelete('cascade');
                  
            $table->foreign('tipo_documento_id')
                  ->references('id')
                  ->on('tipos_documentos')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_ingreso');
    }
};