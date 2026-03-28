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
        'edad',
        'genero',
        'nacionalidad',
        'estado_civil',
        'telefono_celular',
        'telefono_fijo',
        'email_personal',
        'domicilio',
        'colonia',
        'codigo_postal',
        'municipio',
        'ciudad_poblacion',
        'lugar_nacimiento',
        'puesto',
        'documentos',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'documentos' => 'array',
    ];

    // Tipos de documentos requeridos
    const TIPOS_DOCUMENTOS = [
        'solicitud_empleo' => [
            'nombre' => 'Solicitud de Empleo',
            'icono' => 'file-alt',
            'descripcion' => 'Formato de solicitud de empleo'
        ],
        'curriculum_vitae' => [
            'nombre' => 'Curriculum Vitae',
            'icono' => 'file-alt',
            'descripcion' => 'Hoja de vida actualizada'
        ],
        'acta_nacimiento' => [
            'nombre' => 'Acta de Nacimiento',
            'icono' => 'file',
            'descripcion' => 'Acta de nacimiento certificada'
        ],
        'curp_documento' => [
            'nombre' => 'CURP',
            'icono' => 'id-card',
            'descripcion' => 'CURP (Formato página RENAPO)'
        ],
        'constancia_fiscal' => [
            'nombre' => 'Constancia de Situación Fiscal',
            'icono' => 'file-invoice',
            'descripcion' => 'Constancia de situación fiscal (SAT)'
        ],
        'nss' => [
            'nombre' => 'Número de Seguridad Social',
            'icono' => 'heartbeat',
            'descripcion' => 'NSS (Formato página IMSS)'
        ],
        'ine' => [
            'nombre' => 'INE',
            'icono' => 'id-card',
            'descripcion' => 'Identificación oficial vigente'
        ],
        'comprobante_domicilio' => [
            'nombre' => 'Comprobante de Domicilio',
            'icono' => 'home',
            'descripcion' => 'Comprobante de domicilio reciente'
        ],
        'comprobante_estudios' => [
            'nombre' => 'Comprobante de Estudios',
            'icono' => 'graduation-cap',
            'descripcion' => 'Último grado de estudios'
        ],
        'certificado_medico' => [
            'nombre' => 'Certificado Médico',
            'icono' => 'file-medical',
            'descripcion' => 'Certificado médico vigente'
        ]
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
     * Calcular edad automáticamente
     */
    public function setFechaNacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = $value;
        if ($value) {
            $this->attributes['edad'] = \Carbon\Carbon::parse($value)->age;
        }
    }

    /**
     * Obtener la URL de un documento específico
     */
    public function getDocumentoUrl($tipo): ?string
    {
        $documento = $this->documentosAdmin()->where('tipo', $tipo)->first();
        return $documento ? asset('storage/' . $documento->ruta_archivo) : null;
    }

    /**
     * Verificar si tiene todos los documentos requeridos
     */
    public function getDocumentosCompletosAttribute()
    {
        $tiposRequeridos = array_keys(self::TIPOS_DOCUMENTOS);
        
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
        $tiposRequeridos = array_keys(self::TIPOS_DOCUMENTOS);
        
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
}