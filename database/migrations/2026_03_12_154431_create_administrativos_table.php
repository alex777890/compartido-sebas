<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('administrativos', function (Blueprint $table) {
            // === NUEVOS CAMPOS PARA EL PERFIL ===
            
            // Datos personales (separados)
            $table->string('nombres', 100)->nullable()->after('user_id');
            $table->string('apellido_paterno', 50)->nullable()->after('nombres');
            $table->string('apellido_materno', 50)->nullable()->after('apellido_paterno');
            
            // Datos de contacto
            $table->string('telefono_celular', 20)->nullable()->after('apellido_materno');
            $table->string('telefono_fijo', 20)->nullable()->after('telefono_celular');
            $table->string('email_personal', 100)->nullable()->after('telefono_fijo');
            
            // Información personal
            $table->date('fecha_nacimiento')->nullable()->after('email_personal');
            $table->integer('edad')->nullable()->after('fecha_nacimiento');
            $table->enum('genero', ['M', 'F', 'OTRO'])->nullable()->after('edad');
            $table->string('nacionalidad', 100)->nullable()->after('genero');
            $table->string('estado_civil', 50)->nullable()->after('nacionalidad');
            $table->string('lugar_nacimiento', 200)->nullable()->after('estado_civil');
            
            // Dirección
            $table->string('domicilio')->nullable()->after('lugar_nacimiento');
            $table->string('colonia', 100)->nullable()->after('domicilio');
            $table->string('codigo_postal', 10)->nullable()->after('colonia');
            $table->string('municipio', 100)->nullable()->after('codigo_postal');
            $table->string('ciudad_poblacion', 100)->nullable()->after('municipio');
            
            // Información laboral
            $table->string('puesto', 100)->nullable()->after('ciudad_poblacion');
            
            // Nota: Los campos curp, rfc, fecha_ingreso, numero_empleado, area_adscripcion, 
            // maximo_grado_estudios, escolaridad, documentos ya no se usan
        });
    }

    public function down()
    {
        Schema::table('administrativos', function (Blueprint $table) {
            $table->dropColumn([
                'nombres',
                'apellido_paterno',
                'apellido_materno',
                'telefono_celular',
                'telefono_fijo',
                'email_personal',
                'fecha_nacimiento',
                'edad',
                'genero',
                'nacionalidad',
                'estado_civil',
                'lugar_nacimiento',
                'domicilio',
                'colonia',
                'codigo_postal',
                'municipio',
                'ciudad_poblacion',
                'puesto'
            ]);
        });
    }
};