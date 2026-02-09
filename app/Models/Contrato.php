<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos'; // Asegúrate de que el nombre de la tabla sea correcto
    
    protected $fillable = [
        'nombre',
        'template_id',
        'data',
        'generated_file',
        'year',
        'coordinacion_id', // Agrega esto
        'status', // Si tienes este campo
    ];

    protected $casts = [
        'data' => 'array',
    ];

    // Relación con la coordinación
    public function coordinacion()
    {
        return $this->belongsTo(Coordinacion::class, 'coordinacion_id');
    }

    // Relación con la plantilla
    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }
}