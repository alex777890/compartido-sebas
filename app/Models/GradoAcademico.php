<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradoAcademico extends Model
{
    use HasFactory;

    protected $table = 'grados_academicos';

    protected $fillable = [
        'maestro_id',
        'nivel',
        'nombre_titulo',
        'cedula_profesional',
        'fecha_expedicion_cedula',
        'institucion',
        'ano_obtencion',
        'observaciones',
        'documento',
        'observaciones'
    ];

    protected $casts = [
        'fecha_expedicion_cedula' => 'date',
        'ano_obtencion' => 'integer',
    ];

    public function maestro(): BelongsTo
    {
        return $this->belongsTo(Maestro::class);
    }

    // Accesor para mostrar la fecha formateada
    public function getFechaExpedicionFormateadaAttribute()
    {
        return $this->fecha_expedicion_cedula 
            ? $this->fecha_expedicion_cedula->format('d/m/Y')
            : 'No especificada';
    }

    // Accesor para el nivel con icono
    public function getNivelConIconoAttribute()
    {
        $iconos = [
            'Licenciatura' => 'fas fa-user-graduate',
            'Especialidad' => 'fas fa-certificate',
            'Maestría' => 'fas fa-graduation-cap',
            'Doctorado' => 'fas fa-user-tie'
        ];

        $icono = $iconos[$this->nivel] ?? 'fas fa-graduation-cap';
        return '<i class="'.$icono.' me-2"></i>' . $this->nivel;
    }
}