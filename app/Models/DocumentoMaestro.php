<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoMaestro extends Model
{
    use HasFactory;

    protected $table = 'documentos_maestros';

    protected $fillable = [
        'maestro_id',
        'periodo_id', // ✅ AGREGAR ESTE CAMPO SI YA LO TIENES EN LA TABLA
        'tipo',
        'nombre_archivo',
        'ruta_archivo',
        'mime_type',
        'tamanio',
        'estado',
        'observaciones_documento',
        'observaciones_admin',
        'estatus',
        'fecha_revision',
        'revisado_por'
    ];

    protected $casts = [
        'fecha_revision' => 'datetime',
        'tamanio' => 'integer'
    ];

    // Relación con el maestro
    public function maestro()
    {
        return $this->belongsTo(Maestro::class);
    }

    // ✅ AGREGAR ESTA RELACIÓN CON PERIODO
    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'periodo_id');
    }

    // Relación con el usuario que revisó
    public function revisadoPor()
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }

    // Scopes para facilitar consultas
    public function scopePendientes($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeAprobados($query)
    {
        return $query->where('estado', 'aprobado');
    }

    public function scopeRechazados($query)
    {
        return $query->where('estado', 'rechazado');
    }

    public function scopeCompletos($query)
    {
        return $query->where('estatus', 'completo');
    }

    public function scopeIncompletos($query)
    {
        return $query->where('estatus', 'incompleto');
    }

    public function scopeEnRevision($query)
    {
        return $query->where('estatus', 'en_revision');
    }

    // ✅ NUEVO SCOPE: Documentos por período
    public function scopePorPeriodo($query, $periodoId)
    {
        return $query->where('periodo_id', $periodoId);
    }

    // ✅ NUEVO SCOPE: Documentos del período activo
    public function scopeDelPeriodoActivo($query)
    {
        $periodoActivo = Periodo::getPeriodoSubidaHabilitada();
        if ($periodoActivo) {
            return $query->where('periodo_id', $periodoActivo->id);
        }
        return $query;
    }

    // Métodos helper
    public function getEstadoBadgeClass()
    {
        switch($this->estado) {
            case 'aprobado': return 'badge badge-success';
            case 'rechazado': return 'badge badge-danger';
            default: return 'badge badge-warning';
        }
    }

    public function getEstatusBadgeClass()
    {
        switch($this->estatus) {
            case 'completo': return 'badge badge-success';
            case 'en_revision': return 'badge badge-info';
            default: return 'badge badge-secondary';
        }
    }

    public function getTipoNombreAttribute()
    {
        $tipos = [
            'cst' => 'CST',
            'iufim' => 'IUFIM',
            'comprobante_domicilio' => 'Comprobante de Domicilio',
            'oficio_ingresos' => 'Oficio de Ingresos',
            'declaracion_anual' => 'Declaración Anual',
            'comprobante_seguro_social' => 'Comprobante Seguro Social',
            'otro' => 'Otro Documento'
        ];

        return $tipos[$this->tipo] ?? $this->tipo;
    }

    // ✅ NUEVO MÉTODO: Verificar si el documento puede ser editado
    public function puedeEditarse()
    {
        // Permitir edición solo si está pendiente o si el período está activo
        return $this->estado === 'pendiente' || 
               ($this->periodo && $this->periodo->subida_habilitada);
    }

    // ✅ NUEVO MÉTODO: Obtener nombre del período
    public function getNombrePeriodoAttribute()
    {
        return $this->periodo ? $this->periodo->nombre : 'Sin período';
    }
}