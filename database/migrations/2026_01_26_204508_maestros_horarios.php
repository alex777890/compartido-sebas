<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periodo_id')->constrained('periodos');
            $table->foreignId('maestro_id')->constrained('maestros');   
            $table->string('materia_nombre');
            $table->string('grupo');
            $table->string('aula');
            
            // 🔥 CAMBIO: En lugar de un día específico, guardamos TODOS los días
            $table->json('dias')->comment('Días en formato JSON, ej: ["Lunes", "Miercoles"]');
            
            // 🔥 CAMBIO: En lugar de una hora específica, guardamos el rango de horas
            $table->string('horario_inicio', 5)->comment('Formato: "08:00"');
            $table->string('horario_fin', 5)->comment('Formato: "10:00"');
            
            // 🔥 NUEVO: Campo para calcular duración total
            $table->integer('duracion_horas')->default(1)->comment('Duración total en horas');
            
            // 🔥 NUEVO: Campo para la evidencia digital del horario (UN SOLO ARCHIVO)
            $table->string('horario_foto')->nullable()->comment('Ruta de la imagen del horario digital');
            
            $table->timestamps();
            
            // Índices optimizados
            $table->index(['periodo_id', 'maestro_id']);
            $table->index(['maestro_id', 'periodo_id']);
            $table->index('materia_nombre');
            $table->index('horario_foto');
            
            // 🔥 NUEVO: Índice para búsqueda por días
            $table->index(['dias']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};