<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maestro_periodo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maestro_id')
                  ->constrained('maestros')
                  ->onDelete('cascade');
            $table->foreignId('periodo_id')
                  ->constrained('periodos')
                  ->onDelete('cascade');
            $table->integer('anio_periodo'); // NUEVO: Año del periodo
            $table->json('meses_trabajados')->nullable(); // Array de meses [1,2,3] o [8,9,10,11,12]
            $table->integer('total_meses')->default(0); // Total calculado automáticamente
            $table->timestamps();
            
            // Índice único para evitar duplicados - MODIFICADO para incluir anio_periodo
            $table->unique(['maestro_id', 'periodo_id', 'anio_periodo'], 'maestro_periodo_unique');
            
            // Índices para mejor rendimiento
            $table->index('maestro_id');
            $table->index('periodo_id');
            $table->index('anio_periodo'); // NUEVO índice
            $table->index('total_meses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maestro_periodo');
    }
};