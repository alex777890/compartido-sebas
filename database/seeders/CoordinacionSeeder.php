<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coordinacion;

class CoordinacionSeeder extends Seeder
{
    public function run()
    {
        $coordinaciones = [
            'Cirujano dentista',
            'Preparatoria',
            'Imagen',
            'Negocios',
            'Comunicación',
            'Derecho',
            'Lenguas',
            'Idiomas',
            'Ortodoncia',
            'Cifi',
            'Promotoria',
            'Talleres Culturales'
        ];

        foreach ($coordinaciones as $coordinacion) {
            Coordinacion::create(['nombre' => $coordinacion]);
        }
    }
}