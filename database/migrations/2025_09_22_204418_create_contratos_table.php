<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('template_id')->nullable()->constrained('templates')->onDelete('set null');
            $table->json('data')->nullable();
            $table->string('generated_file')->nullable();
            $table->integer('year')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};