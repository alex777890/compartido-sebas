<?php
// app/Models/TipoDocumento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;

    protected $table = 'tipos_documentos';

    protected $fillable = [
        'nombre' // Solo nombre, sin orden
    ];

    public function documentos()
    {
        return $this->hasMany(DocumentoMaestro::class, 'tipo_documento_id');
    }
}