<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up()
{
    Schema::create('proceso_documentos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('maestro_id');
        $table->unsignedBigInteger('admin_id')->nullable();
        $table->boolean('activo')->default(true);
        $table->timestamp('fecha_activacion')->useCurrent();
        $table->timestamp('fecha_fin')->nullable();
        $table->timestamps();
        
        $table->foreign('maestro_id')->references('id')->on('maestros')->onDelete('cascade');
        $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
