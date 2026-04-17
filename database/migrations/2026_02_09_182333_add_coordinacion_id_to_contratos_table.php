<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contratos', function (Blueprint $table) {
            // Verificar si la columna ya existe antes de agregarla
            if (!Schema::hasColumn('contratos', 'coordinacion_id')) {
                $table->foreignId('coordinacion_id')
                    ->nullable()
                    ->constrained('coordinaciones')
                    ->onDelete('set null')
                    ->after('template_id');
            }
        });
    }

    public function down()
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['coordinacion_id']);
            $table->dropColumn('coordinacion_id');
        });
    }
};