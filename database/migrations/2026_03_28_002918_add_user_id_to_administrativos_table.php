<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Schema::table('administrativos', function (Blueprint $table) {
    $table->foreignId('user_id')
          ->nullable()
          ->constrained()
          ->onDelete('cascade');
});