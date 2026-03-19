<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcesoDocumento extends Model
{
    use HasFactory;

    protected $table = 'proceso_documentos';
    
    protected $fillable = [
        'maestro_id',
        'admin_id',
        'activo',
        'fecha_activacion',
        'fecha_fin'
    ];

    protected $casts = [
        'activo' => 'boolean',
        'fecha_activacion' => 'datetime',
        'fecha_fin' => 'datetime'
    ];

    public function maestro()
    {
        return $this->belongsTo(Maestro::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}