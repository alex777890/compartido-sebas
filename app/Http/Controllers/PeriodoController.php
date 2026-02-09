<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\DocumentoMaestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // ✅ AGREGAR ESTA LÍNEA

class PeriodoController extends Controller
{
    public function __construct()
    {
        // Actualizar estados automáticamente al acceder
        $this->middleware(function ($request, $next) {
            Periodo::actualizarEstadosPeriodos();
            return $next($request);
        });
    }

    public function index()
    {
        // 1. GENERAR PERÍODOS AL ENTRAR A LA PÁGINA
        Periodo::generarPeriodosFuturosSiEsNecesario();
        
        // 2. Obtener todos los períodos
        $periodos = Periodo::withCount('documentos')
            ->orderBy('fecha_inicio', 'desc')
            ->get();
        
        // 3. Obtener período actual
        $periodoActual = Periodo::getPeriodoActual();
        
        // 4. Obtener período con subida habilitada
        $periodoSubida = Periodo::getPeriodoSubidaHabilitada();
        
        // 5. Contar total de documentos
        $totalDocumentos = DocumentoMaestro::count();
        
        return view('periodos.index', compact(
            'periodos', 
            'periodoActual', 
            'periodoSubida',
            'totalDocumentos'
        ));
    }

    public function toggleSubida(Periodo $periodo)
{
    Log::info('=== TOGGLE SUBIDA - VERSIÓN CON VERIFICACIÓN DIRECTA ===');
    
    // ✅ Validar que no esté finalizado
    if ($periodo->estado == 'finalizado') {
        return back()->with('error', 'No se puede habilitar/deshabilitar subida en un período finalizado');
    }
    
    try {
        // ✅ VERIFICACIÓN ANTES: Qué hay en BD ANTES del cambio
        Log::info("=== ANTES DEL CAMBIO ===");
        $periodosAntes = DB::table('periodos')
            ->where('subida_habilitada', 1)
            ->select('id', 'nombre', 'subida_habilitada')
            ->get();
        
        Log::info("Períodos habilitados ANTES: " . $periodosAntes->count());
        foreach ($periodosAntes as $p) {
            Log::info("  - {$p->id}: {$p->nombre} = {$p->subida_habilitada}");
        }
        
        // ✅ Obtener el valor actual DIRECTAMENTE de la BD (no del modelo)
        $periodoBD = DB::table('periodos')->where('id', $periodo->id)->first();
        $valorActual = $periodoBD->subida_habilitada;
        $nuevoValor = $valorActual ? 0 : 1; // Usar 1/0 para MySQL
        
        Log::info("Período ID {$periodo->id}: valor actual = {$valorActual}, nuevo valor = {$nuevoValor}");
        
        // ✅ EJECUCIÓN DIRECTA EN BD (sin Eloquent)
        if ($nuevoValor == 1) {
            // Deshabilitar TODOS primero
            DB::table('periodos')->update(['subida_habilitada' => 0]);
            Log::info("✅ TODOS los períodos deshabilitados (set a 0)");
        }
        
        // Habilitar/deshabilitar este período específico
        DB::table('periodos')
            ->where('id', $periodo->id)
            ->update([
                'subida_habilitada' => $nuevoValor,
                'updated_at' => now()
            ]);
        
        Log::info("✅ Período ID {$periodo->id} actualizado a: {$nuevoValor}");
        
        // ✅ VERIFICACIÓN DESPUÉS: Qué hay en BD DESPUÉS del cambio
        Log::info("=== DESPUÉS DEL CAMBIO ===");
        $periodosDespues = DB::table('periodos')
            ->where('subida_habilitada', 1)
            ->select('id', 'nombre', 'subida_habilitada', 'updated_at')
            ->get();
        
        Log::info("Períodos habilitados DESPUÉS: " . $periodosDespues->count());
        foreach ($periodosDespues as $p) {
            Log::info("  - {$p->id}: {$p->nombre} = {$p->subida_habilitada} (updated: {$p->updated_at})");
        }
        
        // ✅ VERIFICACIÓN FINAL CON CONSULTA SQL DIRECTA
        $verificacionFinal = DB::select("
            SELECT id, nombre, subida_habilitada, updated_at 
            FROM periodos 
            WHERE subida_habilitada = 1
        ");
        
        Log::info("=== VERIFICACIÓN SQL DIRECTA ===");
        Log::info("Resultados: " . count($verificacionFinal));
        foreach ($verificacionFinal as $row) {
            Log::info("  - ID {$row->id}: {$row->nombre}, valor: {$row->subida_habilitada}, updated: {$row->updated_at}");
        }
        
        $mensaje = $nuevoValor == 1 
            ? '✅ Período HABILITADO correctamente. Los maestros ya pueden subir documentos.' 
            : 'Período DESHABILITADO correctamente.';
        
        return back()->with('success', $mensaje);
        
    } catch (\Exception $e) {
        Log::error('❌ ERROR CRÍTICO en toggleSubida: ' . $e->getMessage());
        Log::error('Trace: ' . $e->getTraceAsString());
        
        return back()->with('error', 'Error al cambiar estado: ' . $e->getMessage());
    }
}

    public function finalizar(Periodo $periodo)
    {
        try {
            // ✅ Validar que el período no esté ya finalizado
            if ($periodo->estado == 'finalizado') {
                return back()->with('error', 'El período ya está finalizado');
            }
            
            // ✅ Deshabilitar subida si está habilitada
            if ($periodo->subida_habilitada) {
                $periodo->update(['subida_habilitada' => false]);
            }
            
            // ✅ Marcar como finalizado
            $periodo->update(['estado' => 'finalizado']);
            
            Log::info("Período {$periodo->nombre} (ID: {$periodo->id}) finalizado manualmente por usuario");
            
            return back()->with('success', 'Período marcado como finalizado exitosamente');
            
        } catch (\Exception $e) {
            Log::error('Error al finalizar período: ' . $e->getMessage());
            return back()->with('error', 'Error al finalizar el período: ' . $e->getMessage());
        }
    }

    // ✅ NUEVO: Método para reabrir un período finalizado
    public function reabrir(Periodo $periodo)
    {
        try {
            // Solo se puede reabrir si está finalizado
            if ($periodo->estado != 'finalizado') {
                return back()->with('error', 'Solo se pueden reabrir períodos finalizados');
            }
            
            // Reabrir como inactivo
            $periodo->update([
                'estado' => 'inactivo',
                'subida_habilitada' => false
            ]);
            
            Log::info("Período {$periodo->nombre} (ID: {$periodo->id}) reabierto por usuario");
            
            return back()->with('success', 'Período reabierto exitosamente. Puedes habilitarlo si lo deseas.');
            
        } catch (\Exception $e) {
            Log::error('Error al reabrir período: ' . $e->getMessage());
            return back()->with('error', 'Error al reabrir el período');
        }
    }

    public function generarPeriodosManualmente()
    {
        try {
            Periodo::generarPeriodosFuturosSiEsNecesario();
            
            $count = Periodo::count();
            
            return response()->json([
                'success' => true,
                'message' => "✅ Períodos generados. Total: {$count} períodos."
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al generar períodos: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => '❌ Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function documentos($id)
    {
        $periodo = Periodo::with(['documentos.maestro'])->findOrFail($id);
        return view('periodos.documentos', compact('periodo'));
    }
}