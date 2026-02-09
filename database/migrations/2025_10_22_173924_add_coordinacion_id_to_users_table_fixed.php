<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Verificar si la tabla coordinaciones existe
        if (Schema::hasTable('coordinaciones')) {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignId('coordinaciones_id')
                      ->nullable()
                      ->constrained('coordinaciones')
                      ->onDelete('set null');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['coordinaciones_id']);
            $table->dropColumn('coordinaciones_id');
        });
    }
};