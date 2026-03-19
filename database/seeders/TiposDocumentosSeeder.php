<?php
// database/seeders/TiposDocumentosSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoDocumento;

class TiposDocumentosSeeder extends Seeder
{
    public function run(): void
    {
        $documentos = [
            ['nombre' => 'Formato administrativo IUFIM'],
            ['nombre' => 'Curriculum Vitae'],
            ['nombre' => 'Acta de Nacimiento'],
            ['nombre' => 'CURP'],
            ['nombre' => 'Oficio de Ingresos Percibidos'],
            ['nombre' => 'Constancia situación fiscal'],
            ['nombre' => 'Declaración anual'],
            ['nombre' => 'INE'],
            ['nombre' => 'Actualizaciones o cursos recientes'],
            ['nombre' => 'Certificado Médico'],
            ['nombre' => 'Comprobante de domicilio'],
            ['nombre' => 'Estado de Cuenta Santander'],
            ['nombre' => 'Comprobante de seguro social'],
        ];

        foreach ($documentos as $doc) {
            TipoDocumento::create($doc);
        }
    }
}