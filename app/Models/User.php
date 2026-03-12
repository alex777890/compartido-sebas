<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// 👇 IMPORTAR EL MODELO ADMINISTRATIVO (esto es lo único que faltaba)
use App\Models\Administrativo;

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
     */
    public function coordinacion()
    {
        return $this->belongsTo(
            Coordinacion::class, 
            'coordinaciones_id',
            'id'
        );
    }

    /**
     * Relación con administrativos (si aplica)
     */
    public function administrativo()
    {
        return $this->hasOne(Administrativo::class, 'user_id');
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
     * Verificar si el usuario es directivo
     */
    public function isDirectivo()
    {
        return $this->role === 'directivos';
    }

    /**
     * Verificar si el usuario es administrativo (NUEVO)
     */
    public function isAdministrativo()
    {
        return $this->role === 'administrativos';
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

    /**
     * Verificar si el perfil de administrativo está completo
     */
    public function perfilAdministrativoCompleto()
    {
        if ($this->role !== 'administrativos') {
            return true;
        }
        
        return $this->administrativo()->exists();
    }
}