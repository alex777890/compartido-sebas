<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'subida_habilitada'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'subida_habilitada' => 'boolean'
    ];

    // Relación con documentos
    public function documentos()
    {
        return $this->hasMany(DocumentoMaestro::class, 'periodo_id');
    }

    // MÉTODO PRINCIPAL - Se ejecuta automáticamente
    protected static function boot()
    {
        parent::boot();

        // Cuando se crea un período, generar automáticamente los siguientes
        static::created(function ($periodo) {
            self::generarPeriodosFuturosSiEsNecesario();
        });
    }

    // Método que se ejecuta desde cualquier página
    public static function verificarYGenerarPeriodos()
    {
        // Solo ejecutar una vez al día
        $ultimaVerificacion = cache()->get('ultima_generacion_periodos');
        
        if (!$ultimaVerificacion || now()->diffInDays($ultimaVerificacion) >= 1) {
            self::generarPeriodosFuturosSiEsNecesario();
            cache()->put('ultima_generacion_periodos', now(), now()->addDay());
        }
    }

    // Generar períodos para los próximos 7 años
    public static function generarPeriodosFuturosSiEsNecesario()
    {
        try {
            // Obtener el último período creado
            $ultimoPeriodo = self::orderBy('fecha_inicio', 'desc')->first();
            
            if (!$ultimoPeriodo) {
                // Si no hay períodos, crear desde 2025 hasta 2032
                $anioInicio = 2025;
                $aniosFuturos = 7;
                
                for ($anio = $anioInicio; $anio <= $anioInicio + $aniosFuturos; $anio++) {
                    self::crearPeriodosParaAnio($anio);
                }
                
                Log::info('Períodos generados inicialmente desde ' . $anioInicio . ' hasta ' . ($anioInicio + $aniosFuturos));
                return;
            }
            
            // Verificar si necesitamos crear más períodos
            $anioUltimoPeriodo = $ultimoPeriodo->fecha_fin->year;
            $anioActual = date('Y');
            $aniosFuturos = 7; // Generar para 7 años adelante
            
            // Solo generar si faltan años
            if ($anioUltimoPeriodo < ($anioActual + $aniosFuturos)) {
                for ($anio = $anioUltimoPeriodo + 1; $anio <= $anioActual + $aniosFuturos; $anio++) {
                    self::crearPeriodosParaAnio($anio);
                }
                
                Log::info('Períodos generados adicionalmente desde ' . ($anioUltimoPeriodo + 1) . ' hasta ' . ($anioActual + $aniosFuturos));
            }
            
        } catch (\Exception $e) {
            Log::error('Error al generar períodos: ' . $e->getMessage());
        }
    }
    
    // Crear períodos A y B para un año específico
    private static function crearPeriodosParaAnio($anio)
    {
        // Período A: Febrero - Julio
        $codigoA = "{$anio}-A";
        if (!self::where('codigo', $codigoA)->exists()) {
            try {
                self::create([
                    'nombre' => "Febrero-Julio {$anio}",
                    'codigo' => $codigoA,
                    'fecha_inicio' => Carbon::create($anio, 2, 1), // 1 de Febrero
                    'fecha_fin' => Carbon::create($anio, 7, 31),   // 31 de Julio
                    'estado' => 'inactivo',
                    'subida_habilitada' => false
                ]);
                Log::info("Período creado: {$codigoA}");
            } catch (\Exception $e) {
                Log::error("Error al crear período {$codigoA}: " . $e->getMessage());
            }
        }
        
        // Período B: Agosto - Enero (del siguiente año)
        $codigoB = "{$anio}-B";
        if (!self::where('codigo', $codigoB)->exists()) {
            try {
                self::create([
                    'nombre' => "Agosto {$anio} - Enero " . ($anio + 1),
                    'codigo' => $codigoB,
                    'fecha_inicio' => Carbon::create($anio, 8, 1),  // 1 de Agosto
                    'fecha_fin' => Carbon::create($anio + 1, 1, 31), // 31 de Enero siguiente año
                    'estado' => 'inactivo',
                    'subida_habilitada' => false
                ]);
                Log::info("Período creado: {$codigoB}");
            } catch (\Exception $e) {
                Log::error("Error al crear período {$codigoB}: " . $e->getMessage());
            }
        }
    }
    
    // ✅ NUEVO: Determinar estado basado en fechas PERO respetando finalización manual
    private static function determinarEstado($fechaInicio, $fechaFin, $estadoActual)
    {
        // Si ya está finalizado manualmente, mantenerlo así
        if ($estadoActual == 'finalizado') {
            return 'finalizado';
        }
        
        $hoy = Carbon::now();
        
        if ($hoy->lt($fechaInicio)) {
            return 'inactivo';
        } elseif ($hoy->gt($fechaFin)) {
            return 'finalizado'; // Solo si NO está habilitado
        } else {
            return 'activo';
        }
    }
    
    // ✅ ACTUALIZADO: Actualizar estados de todos los períodos CON LÓGICA DE SUBIDA HABILITADA
public static function actualizarEstadosPeriodos()
{
    try {
        $periodos = self::all();
        $actualizados = 0;
        
        foreach ($periodos as $periodo) {
            // ✅ **NUEVA LÓGICA CRÍTICA: Si tiene subida habilitada, poner como ACTIVO**
            if ($periodo->subida_habilitada && $periodo->estado != 'activo') {
                $periodo->estado = 'activo';
                $periodo->save();
                $actualizados++;
                Log::info("✅ Período {$periodo->nombre} marcado como ACTIVO (subida habilitada)");
                continue; // Saltar al siguiente período
            }
            
            // ✅ **NUEVA LÓGICA: Si NO tiene subida habilitada y está activo, poner como inactivo**
            if (!$periodo->subida_habilitada && $periodo->estado == 'activo') {
                $periodo->estado = 'inactivo';
                $periodo->save();
                $actualizados++;
                Log::info("⚠️ Período {$periodo->nombre} marcado como INACTIVO (subida deshabilitada)");
                continue;
            }
            
            // Si está finalizado manualmente, no tocarlo
            if ($periodo->estado == 'finalizado') {
                continue;
            }
            
            // Lógica original de fechas
            $nuevoEstado = self::determinarEstado($periodo->fecha_inicio, $periodo->fecha_fin, $periodo->estado);
            
            if ($periodo->estado !== $nuevoEstado) {
                $periodo->estado = $nuevoEstado;
                
                // Si se marca como finalizado automáticamente, deshabilitar subida
                if ($nuevoEstado == 'finalizado') {
                    $periodo->subida_habilitada = false;
                }
                
                $periodo->save();
                $actualizados++;
            }
        }
        
        if ($actualizados > 0) {
            Log::info("✅ Estados actualizados: {$actualizados} períodos");
        }
        
    } catch (\Exception $e) {
        Log::error('Error al actualizar estados: ' . $e->getMessage());
    }
}
    
    public static function getPeriodoActual()
    {
        try {
            $hoy = Carbon::now();
            
            $periodo = self::where('fecha_inicio', '<=', $hoy)
                            ->where('fecha_fin', '>=', $hoy)
                            ->where('estado', '!=', 'finalizado')
                            ->first();
            
            // Si no hay período actual, obtener el más reciente no finalizado
            if (!$periodo) {
                $periodo = self::where('estado', '!=', 'finalizado')
                                ->orderBy('fecha_fin', 'desc')
                                ->first();
            }
            
            return $periodo;
        } catch (\Exception $e) {
            Log::error('Error al obtener período actual: ' . $e->getMessage());
            return null;
        }
    }

    // ✅ NUEVO: Método ESPECÍFICO para maestros - busca solo por subida_habilitada
public static function getPeriodoParaMaestros()
{
    try {
        Log::info('=== BUSCANDO PERÍODO PARA MAESTROS ===');
        
        // Buscar CUALQUIER período con subida_habilitada = true
        $periodo = self::where('subida_habilitada', true)->first();
        
        if ($periodo) {
            Log::info("✅ Período encontrado para maestros: {$periodo->nombre}");
            Log::info("   ID: {$periodo->id}, Estado: {$periodo->estado}, Subida: " . ($periodo->subida_habilitada ? 'SI' : 'NO'));
            return $periodo;
        }
        
        Log::warning("⚠️ No hay período con subida_habilitada = true");
        return null;
        
    } catch (\Exception $e) {
        Log::error('Error en getPeriodoParaMaestros: ' . $e->getMessage());
        return null;
    }
}
    
    public static function getPeriodoSubidaHabilitada()
{
    try {
        // ✅ SIMPLIFICADO: Solo buscar por subida_habilitada (sin filtrar por estado)
        return self::where('subida_habilitada', true)
                    ->first();
    } catch (\Exception $e) {
        Log::error('Error al obtener período con subida: ' . $e->getMessage());
        return null;
    }
}
    
    // Obtener próximos períodos
    public static function getProximosPeriodos($limit = 10)
    {
        try {
            $hoy = Carbon::now();
            
            return self::where('fecha_inicio', '>', $hoy)
                        ->where('estado', '!=', 'finalizado')
                        ->orderBy('fecha_inicio')
                        ->limit($limit)
                        ->get();
        } catch (\Exception $e) {
            Log::error('Error al obtener próximos períodos: ' . $e->getMessage());
            return collect();
        }
    }
    
    // Método para contar documentos
    public function getDocumentosCountAttribute()
    {
        return $this->documentos()->count();
    }
    
    // Método para verificar si puede eliminarse
    public function puedeEliminarse()
    {
        return $this->documentos_count === 0;
    }
    
    // ✅ NUEVO: Verificar si es el período actual
    public function esPeriodoActual()
    {
        $periodoActual = self::getPeriodoActual();
        return $periodoActual && $this->id == $periodoActual->id;
    }
    
    // ✅ NUEVO: Verificar si está vigente (dentro de fechas)
    public function estaVigente()
    {
        $hoy = Carbon::now();
        return $hoy >= $this->fecha_inicio && $hoy <= $this->fecha_fin;
    }
}