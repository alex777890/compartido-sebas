<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    
    protected $fillable = [
        'periodo_id', 
        'maestro_id', 
        'materia_nombre',
        'grupo', 
        'aula',
        'dias', // 🔥 CAMBIO: Ahora es JSON
        'horario_inicio',
        'horario_fin',
        'duracion_horas',
        'horario_foto'
    ];
    
    // 🔥 NUEVO: Cast para el campo de días
    protected $casts = [
        'dias' => 'array',
        'horario_foto' => 'string',
        'duracion_horas' => 'integer'
    ];
    
    // 🔥 NUEVO: Appends para acceder a la URL completa de la foto
    protected $appends = ['horario_foto_url', 'horas_totales_semana'];
    
    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($horario) {
            // Calcular duración en horas basado en horario_inicio y horario_fin
            if ($horario->horario_inicio && $horario->horario_fin) {
                $inicio = strtotime($horario->horario_inicio);
                $fin = strtotime($horario->horario_fin);
                $horario->duracion_horas = ($fin - $inicio) / 3600; // Convertir segundos a horas
            }
            
            // Asegurar que días sea un array
            if (is_string($horario->dias)) {
                $horario->dias = json_decode($horario->dias, true);
            }
        });
    }
    
    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
    
    public function maestro()
    {
        return $this->belongsTo(Maestro::class);
    }
    
    // 🔥 NUEVO: Accessor para obtener la URL completa de la foto
    public function getHorarioFotoUrlAttribute()
    {
        if (!$this->horario_foto) {
            return null;
        }
        
        // Si ya es una URL completa, retornarla directamente
        if (filter_var($this->horario_foto, FILTER_VALIDATE_URL)) {
            return $this->horario_foto;
        }
        
        // Si es una ruta relativa, generar la URL completa
        return asset('storage/' . $this->horario_foto);
    }
    
    // 🔥 NUEVO: Método para verificar si tiene foto de horario
    public function tieneHorarioFoto()
    {
        return !empty($this->horario_foto);
    }
    
    // 🔥 NUEVO: Método para obtener horas totales por semana
    public function getHorasTotalesSemanaAttribute()
    {
        if (!$this->dias || !$this->duracion_horas) {
            return 0;
        }
        
        $diasCount = count($this->dias);
        return $diasCount * $this->duracion_horas;
    }
    
    // 🔥 NUEVO: Método para obtener el formato de horario legible
    public function getHorarioLegibleAttribute()
    {
        return $this->horario_inicio . ' - ' . $this->horario_fin;
    }
    
    // 🔥 NUEVO: Método para obtener días como string
    public function getDiasStringAttribute()
    {
        if (!$this->dias || empty($this->dias)) {
            return '';
        }
        
        return implode(', ', $this->dias);
    }
    
    // 🔥 NUEVO: Método estático para calcular horas totales de un maestro
    public static function calcularHorasTotalesMaestro($maestroId, $periodoId)
    {
        return self::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->get()
            ->sum('horas_totales_semana');
    }
}