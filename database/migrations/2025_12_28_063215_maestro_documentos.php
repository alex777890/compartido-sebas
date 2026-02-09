<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documentos_maestros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maestro_id')->constrained('maestros')->onDelete('cascade');
            $table->foreignId('periodo_id')->constrained('periodos')->onDelete('cascade'); // IMPORTANTE: agregado constrained
            $table->enum('tipo', [
                'cst',
                'iufim', 
                'comprobante_domicilio',
                'oficio_ingresos',
                'declaracion_anual',
                'comprobante_seguro_social',
                'otro'
            ]);
            $table->string('nombre_archivo');
            $table->string('ruta_archivo');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('tamanio')->nullable();
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            
            $table->text('observaciones_documento')->nullable();
            $table->text('observaciones_admin')->nullable();
            $table->dateTime('fecha_revision')->nullable();
            $table->foreignId('revisado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('estatus', ['completo', 'incompleto', 'en_revision'])->default('incompleto');
            
            $table->timestamps();
            
            // RESTRICCIÓN ÚNICA CORREGIDA: Ahora incluye periodo_id
            $table->unique(['maestro_id', 'periodo_id', 'tipo']);
            
            // Índices para mejor performance
            $table->index('estado');
            $table->index('estatus');
            $table->index('maestro_id');
            $table->index('periodo_id'); // Nuevo índice agregado
        });
    }

    public function down()
    {
        Schema::dropIfExists('documentos_maestros');
    }
};