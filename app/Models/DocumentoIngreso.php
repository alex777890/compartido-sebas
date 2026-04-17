<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoIngreso extends Model
{
    protected $table = 'documentos_ingreso';
    
    protected $fillable = [
        'maestro_id',
        'tipo_documento_id',
        'archivo',
        'archivo_original',
        'version',
        'estado',
        'fecha_subida',
        'observaciones'
    ];
    
    protected $casts = [
        'fecha_subida' => 'datetime'
    ];
    
    public function maestro()
    {
        return $this->belongsTo(Maestro::class);
    }
    
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}