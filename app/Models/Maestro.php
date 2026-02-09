<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Maestro extends Model
{
    use HasFactory;

    protected $table = 'maestros';

    protected $fillable = [
    'user_id','coordinaciones_id', 'nombres', 'apellido_paterno', 'apellido_materno',
    'maximo_grado_academico', 'fecha_nacimiento', 'edad',   'activo', 'sexo', 'estado_civil',
    'telefono', 'email', 'direccion', 'rfc', 'curp', 'anio_ingreso'
];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function coordinacion(): BelongsTo
    {
        // Especificar explícitamente la clave foránea 'coordinaciones_id'
    return $this->belongsTo(Coordinacion::class, 'coordinaciones_id');
    }

    // Relación con grados académicos
    public function gradosAcademicos(): HasMany
    {
        return $this->hasMany(GradoAcademico::class);
    }

    public function archivosPdf(): HasOne
    {
        return $this->hasOne(ArchivoPdf::class);
    }

    public function antiguedad(): HasOne
    {
        return $this->hasOne(Antiguedad::class);
    }

    public function horas(): HasOne
    {
        return $this->hasOne(Hora::class);
    }

    public function nominas(): HasMany
    {
        return $this->hasMany(Nomina::class);
    }

    // Accesor para obtener el máximo grado académico basado en los registros
    public function getMaximoGradoCalculadoAttribute()
    {
        $niveles = [
            'Licenciatura' => 1,
            'Especialidad' => 2,
            'Maestría' => 3,
            'Doctorado' => 4
        ];

        $maximoNivel = $this->gradosAcademicos->max(function($grado) use ($niveles) {
            return $niveles[$grado->nivel] ?? 0;
        });

        return array_search($maximoNivel, $niveles) ?: 'No especificado';
    }

    // Contar grados por nivel
    public function contarGradosPorNivel($nivel)
    {
        return $this->gradosAcademicos->where('nivel', $nivel)->count();
    }

    // Obtener grados ordenados por nivel (mayor a menor)
    public function getGradosOrdenadosAttribute()
    {
        $ordenNiveles = ['Doctorado' => 4, 'Maestría' => 3, 'Especialidad' => 2, 'Licenciatura' => 1];
        
        return $this->gradosAcademicos->sortByDesc(function($grado) use ($ordenNiveles) {
            return $ordenNiveles[$grado->nivel] ?? 0;
        });
    }

    // Relación con períodos
public function periodos()
{
    return $this->belongsToMany(Periodo::class, 'maestro_periodo')
                ->withPivot('meses_trabajados', 'total_meses', 'anio_periodo') // ← Asegúrate de incluir anio_periodo aquí
                ->withTimestamps();
}
// Calcular total de meses desde el array
public function calcularTotalMeses($mesesArray)
{
    return is_array($mesesArray) ? count($mesesArray) : 0;
}

// Obtener nombres de meses
public function getNombresMeses($mesesArray)
{
    $nombresMeses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    
    if (!is_array($mesesArray)) return [];
    
    $nombres = [];
    foreach ($mesesArray as $mes) {
        if (isset($nombresMeses[$mes])) {
            $nombres[] = $nombresMeses[$mes];
        }
    }
    
    return $nombres;
}

// Calcular antigüedad total
public function calcularAntiguedadAcumulada()
{
    $totalMeses = $this->periodos->sum('pivot.total_meses');
    
    $anios = floor($totalMeses / 12);
    $meses = $totalMeses % 12;

    $desglosePeriodos = $this->periodos->sortBy('codigo')->map(function($periodo) {
        $mesesArray = json_decode($periodo->pivot->meses_trabajados, true) ?? [];
        return [
            'periodo' => $periodo->nombre,
            'codigo' => $periodo->codigo,
            'meses_trabajados' => $mesesArray,
            'nombres_meses' => $this->getNombresMeses($mesesArray),
            'total_meses' => $periodo->pivot->total_meses
        ];
    });

    return [
        'total_meses' => $totalMeses,
        'anios' => $anios,
        'meses' => $meses,
        'desglose' => $desglosePeriodos,
        'total_periodos' => $this->periodos->count()
    ];
}
    

    // Método para obtener un documento específico por tipo
    public function documento($tipo)
    {
        return $this->documentos()->where('tipo', $tipo)->first();
    }
     public function documentos()
    {
        return $this->hasMany(DocumentoMaestro::class, 'maestro_id');
    }

    // Método para verificar si tiene todos los documentos
    public function getDocumentosCompletosAttribute()
    {
        $tiposRequeridos = ['cst', 'iufim', 'comprobante_domicilio', 'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'];
        $tiposSubidos = $this->documentos->pluck('tipo')->toArray();
        
        return count(array_intersect($tiposRequeridos, $tiposSubidos)) === count($tiposRequeridos);
    }

    // Método para obtener el progreso de documentos
    public function getProgresoDocumentosAttribute()
    {
        $tiposRequeridos = ['cst', 'iufim', 'comprobante_domicilio', 'oficio_ingresos', 'declaracion_anual', 'comprobante_seguro_social'];
        $tiposSubidos = $this->documentos->pluck('tipo')->toArray();
        
        $documentosSubidos = count(array_intersect($tiposRequeridos, $tiposSubidos));
        $totalRequeridos = count($tiposRequeridos);
        
        return [
            'subidos' => $documentosSubidos,
            'total' => $totalRequeridos,
            'porcentaje' => $totalRequeridos > 0 ? ($documentosSubidos / $totalRequeridos) * 100 : 0,
            'faltantes' => $totalRequeridos - $documentosSubidos
        ];
    }

    // Método para obtener documentos por estado
    public function documentosPorEstado($estado = null)
    {
        $query = $this->documentos();
        
        if ($estado) {
            $query->where('estado', $estado);
        }
        
        return $query->get();
    }
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    
    public function horariosPorPeriodo($periodoId)
    {
        return $this->horarios()->where('periodo_id', $periodoId);
    }

}

