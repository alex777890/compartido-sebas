<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('administrativos', function (Blueprint $table) {
            // Agregar nuevos campos para el perfil completo
            $table->string('nombre_completo')->nullable()->after('apellido_materno');
            $table->string('telefono_celular')->nullable()->after('telefono');
            $table->string('telefono_fijo')->nullable()->after('telefono_celular');
            $table->string('nacionalidad')->nullable()->after('email_personal');
            $table->string('estado_civil')->nullable()->after('nacionalidad');
            $table->integer('edad')->nullable()->after('fecha_nacimiento');
            $table->enum('genero', ['M', 'F', 'OTRO'])->nullable()->after('edad');
            $table->string('colonia')->nullable()->after('direccion');
            $table->string('codigo_postal')->nullable()->after('colonia');
            $table->string('municipio')->nullable()->after('codigo_postal');
            $table->string('ciudad_poblacion')->nullable()->after('municipio');
            $table->string('lugar_nacimiento')->nullable()->after('ciudad_poblacion');
            
            // Modificar campos existentes
            $table->string('direccion')->nullable()->change(); // Temporalmente nullable para migración
        });
    }

    public function down()
    {
        Schema::table('administrativos', function (Blueprint $table) {
            $table->dropColumn([
                'nombre_completo',
                'telefono_celular',
                'telefono_fijo',
                'nacionalidad',
                'estado_civil',
                'edad',
                'genero',
                'colonia',
                'codigo_postal',
                'municipio',
                'ciudad_poblacion',
                'lugar_nacimiento'
            ]);
            $table->text('direccion')->change();
        });
    }
};