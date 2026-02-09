<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email', 
        'password',
        'role',
        'coordinaciones_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relación: Un usuario pertenece a una coordinación
     * IMPORTANTE: Especificar la clave foránea porque no sigue la convención
     */
    public function coordinacion()
    {
        return $this->belongsTo(
            Coordinacion::class, 
            'coordinaciones_id', // Nombre de la columna en la tabla users
            'id' // Nombre de la columna en la tabla coordinaciones (por defecto es id)
        );
    }

    /**
     * Verificar si el usuario es admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Verificar si el usuario es profesor
     */
    public function isProfesor()
    {
        return $this->role === 'profesor';
    }

    /**
     * Verificar si el usuario es coordinación
     */
    public function isCoordinacion()
    {
        return $this->role === 'coordinacion';
    }

    /**
     * Obtener el nombre de la coordinación
     */
    public function getNombreCoordinacionAttribute()
    {
        return $this->coordinacion ? $this->coordinacion->nombre : 'Sin coordinación';
    }

    /**
     * Scope para filtrar usuarios por coordinación
     */
    public function scopeDeCoordinacion($query, $coordinacionId)
    {
        return $query->where('coordinaciones_id', $coordinacionId);
    }

    /**
     * Scope para filtrar usuarios por rol
     */
    public function scopePorRol($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope para buscar usuarios por nombre o email
     */
    public function scopeBuscar($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
    }
}