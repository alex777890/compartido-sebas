<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentoAdministrativo extends Model
{
    use HasFactory;

    protected $table = 'documentos_administrativos';

    protected $fillable = [
        'administrativo_id',
        'periodo_id',
        'tipo',
        'nombre_archivo',
        'ruta_archivo',
        'mime_type',
        'tamanio',
        'estado',
        'observaciones_admin',
        'revisado_por',
        'fecha_revision',
    ];

    protected $casts = [
        'fecha_revision' => 'datetime',
    ];

    /**
     * Relación con el administrativo
     */
    public function administrativo(): BelongsTo
    {
        return $this->belongsTo(Administrativo::class);
    }

    /**
     * Relación con el período
     */
    public function periodo(): BelongsTo
    {
        return $this->belongsTo(Periodo::class);
    }

    /**
     * Relación con el usuario que revisó
     */
    public function revisadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopePorEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo', $tipo);
    }

    /**
     * Scope para filtrar por período
     */
    public function scopeEnPeriodo($query, $periodoId)
    {
        return $query->where('periodo_id', $periodoId);
    }

    /**
     * Verificar si está aprobado
     */
    public function isAprobado()
    {
        return $this->estado === 'aprobado';
    }

    /**
     * Verificar si está rechazado
     */
    public function isRechazado()
    {
        return $this->estado === 'rechazado';
    }

    /**
     * Verificar si está pendiente
     */
    public function isPendiente()
    {
        return $this->estado === 'pendiente';
    }
}