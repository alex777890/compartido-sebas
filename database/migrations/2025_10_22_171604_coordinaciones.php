<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('coordinaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->boolean('activo')->default(true); // COLUMNA AGREGADA
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coordinaciones');
    }
};