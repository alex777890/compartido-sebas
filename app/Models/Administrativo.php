<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Administrativo extends Model
{
    use HasFactory;

    protected $table = 'administrativos';

    protected $fillable = [
        'user_id',
        'nombres',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'curp',
        'rfc',
        'telefono',
        'email_personal',
        'direccion',
        'puesto',
        'fecha_ingreso',
        'numero_empleado',
        'area_adscripcion',
        'maximo_grado_estudios',
        'escolaridad',
        'documentos',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'documentos' => 'array',
    ];

    /**
     * Relación con el usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con documentos administrativos
     */
    public function documentosAdmin(): HasMany
    {
        return $this->hasMany(DocumentoAdministrativo::class, 'administrativo_id');
    }

    /**
     * Obtener el nombre completo
     */
    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombres . ' ' . $this->apellido_paterno . ' ' . $this->apellido_materno);
    }

    /**
     * Obtener la URL de un documento específico del JSON
     */
    public function getDocumentoUrl($tipo): ?string
    {
        $documentos = $this->documentos ?? [];
        return isset($documentos[$tipo]) ? asset('storage/' . $documentos[$tipo]) : null;
    }

    /**
     * Verificar si tiene todos los documentos requeridos
     */
    public function getDocumentosCompletosAttribute()
    {
        $tiposRequeridos = [
            'identificacion_oficial',
            'comprobante_domicilio',
            'curriculum',
            'acta_nacimiento'
        ];
        
        $documentosSubidos = $this->documentosAdmin()
            ->whereIn('tipo', $tiposRequeridos)
            ->where('estado', 'aprobado')
            ->count();
        
        return $documentosSubidos === count($tiposRequeridos);
    }

    /**
     * Obtener el progreso de documentos
     */
    public function getProgresoDocumentosAttribute()
    {
        $tiposRequeridos = [
            'identificacion_oficial',
            'comprobante_domicilio',
            'curriculum',
            'acta_nacimiento'
        ];
        
        $documentosSubidos = $this->documentosAdmin()
            ->whereIn('tipo', $tiposRequeridos)
            ->count();
        
        $documentosAprobados = $this->documentosAdmin()
            ->whereIn('tipo', $tiposRequeridos)
            ->where('estado', 'aprobado')
            ->count();
        
        $totalRequeridos = count($tiposRequeridos);
        
        return [
            'subidos' => $documentosSubidos,
            'aprobados' => $documentosAprobados,
            'total' => $totalRequeridos,
            'porcentaje' => $totalRequeridos > 0 ? round(($documentosSubidos / $totalRequeridos) * 100) : 0,
            'faltantes' => $totalRequeridos - $documentosSubidos
        ];
    }

    /**
     * Documentos por estado
     */
    public function documentosPorEstado($estado = null)
    {
        $query = $this->documentosAdmin();
        
        if ($estado) {
            $query->where('estado', $estado);
        }
        
        return $query->get();
    }
}