<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coordinacion extends Model
{
    use HasFactory;

    // Especificar el nombre de la tabla
    protected $table = 'coordinaciones';

    protected $fillable = ['nombre', 'activo'];

    /**
     * CORRECCIÓN: Especificar explícitamente la clave foránea 'coordinaciones_id'
     */
    public function maestros(): HasMany
    {
        return $this->hasMany(Maestro::class, 'coordinaciones_id'); // ← AGREGAR EL SEGUNDO PARÁMETRO
    }
    
    protected $casts = [
        'activo' => 'boolean'
    ];

    /**
     * Relación: Una coordinación tiene muchos usuarios
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Scope para coordinaciones activas
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }
}