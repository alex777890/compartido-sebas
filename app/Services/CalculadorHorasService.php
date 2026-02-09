<?php

namespace App\Services;

use App\Models\Horario;
use Illuminate\Support\Facades\DB;

class CalculadorHorasService
{
    /**
     * Calcular horas del maestro para un periodo (formato antiguo para compatibilidad)
     */
    public function calcularHorasMaestro($maestroId, $periodoId)
    {
        $horarios = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->get();

        $resultado = [
            'Lunes' => ['horas' => 0, 'clases' => []],
            'Martes' => ['horas' => 0, 'clases' => []],
            'Miercoles' => ['horas' => 0, 'clases' => []],
            'Jueves' => ['horas' => 0, 'clases' => []],
            'Viernes' => ['horas' => 0, 'clases' => []],
            'total_horas_semanales' => 0,
            'total_clases' => $horarios->count(),
        ];

        foreach ($horarios as $horario) {
            // 🔥 CAMBIO: $horario->dias es un array JSON, no un string
            $dias = $horario->dias ?? [];
            
            foreach ($dias as $dia) {
                if (isset($resultado[$dia])) {
                    // 🔥 CAMBIO: Usar duracion_horas en lugar de contar 1 hora por defecto
                    $duracion = $horario->duracion_horas ?? 1;
                    
                    $resultado[$dia]['horas'] += $duracion;
                    $resultado[$dia]['clases'][] = [
                        'materia' => $horario->materia_nombre,
                        'horario' => $horario->horario_inicio . ' - ' . $horario->horario_fin,
                        'aula' => $horario->aula,
                        'grupo' => $horario->grupo,
                        'duracion' => $duracion,
                        'horario_inicio' => $horario->horario_inicio,
                        'horario_fin' => $horario->horario_fin
                    ];
                    
                    $resultado['total_horas_semanales'] += $duracion;
                }
            }
        }

        return $resultado;
    }

    /**
     * Obtener horario completo de un maestro para un periodo
     */
    public function obtenerHorarioCompleto($maestroId, $periodoId)
    {
        $horarios = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->orderBy('materia_nombre')
            ->orderBy('horario_inicio')
            ->get();

        $horarioCompleto = [
            'Lunes' => [],
            'Martes' => [],
            'Miercoles' => [],
            'Jueves' => [],
            'Viernes' => []
        ];

        foreach ($horarios as $horario) {
            // 🔥 CAMBIO: $horario->dias es un array
            $dias = $horario->dias ?? [];
            
            foreach ($dias as $dia) {
                if (isset($horarioCompleto[$dia])) {
                    // 🔥 CAMBIO: Convertir horario_inicio/horario_fin a formato antiguo para compatibilidad
                    $horasIndividuales = $this->convertirRangoAHorasIndividuales(
                        $horario->horario_inicio,
                        $horario->horario_fin
                    );
                    
                    foreach ($horasIndividuales as $hora) {
                        $horarioCompleto[$dia][] = [
                            'materia_nombre' => $horario->materia_nombre,
                            'horario' => $hora, // Formato antiguo: "7-8", "8-9"
                            'horario_inicio' => $horario->horario_inicio,
                            'horario_fin' => $horario->horario_fin,
                            'aula' => $horario->aula,
                            'grupo' => $horario->grupo,
                            'dias' => $horario->dias,
                            'duracion_horas' => $horario->duracion_horas ?? 1
                        ];
                    }
                }
            }
        }

        // Ordenar por hora dentro de cada día
        foreach ($horarioCompleto as &$clasesDelDia) {
            usort($clasesDelDia, function($a, $b) {
                $horaA = explode('-', $a['horario'])[0];
                $horaB = explode('-', $b['horario'])[0];
                return $horaA - $horaB;
            });
        }

        return $horarioCompleto;
    }

    /**
     * Convertir rango de horas a horas individuales (para compatibilidad)
     */
    private function convertirRangoAHorasIndividuales($inicio, $fin)
    {
        $horas = [];
        $horaInicio = (int) substr($inicio, 0, 2);
        $horaFin = (int) substr($fin, 0, 2);
        
        for ($i = $horaInicio; $i < $horaFin; $i++) {
            $horas[] = $i . '-' . ($i + 1);
        }
        
        return $horas;
    }

    /**
     * Obtener estadísticas detalladas del maestro
     */
    public function obtenerEstadisticasMaestro($maestroId, $periodoId)
    {
        $horarios = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->get();

        // 🔥 CAMBIO: Calcular horas totales considerando duración y múltiples días
        $totalHoras = 0;
        $horasPorDia = [
            'Lunes' => 0,
            'Martes' => 0,
            'Miercoles' => 0,
            'Jueves' => 0,
            'Viernes' => 0
        ];
        
        $horasPorMateria = [];
        
        foreach ($horarios as $horario) {
            $dias = $horario->dias ?? [];
            $duracion = $horario->duracion_horas ?? 1;
            $horasClase = count($dias) * $duracion;
            
            $totalHoras += $horasClase;
            
            foreach ($dias as $dia) {
                if (isset($horasPorDia[$dia])) {
                    $horasPorDia[$dia] += $duracion;
                }
            }
            
            // Acumular horas por materia
            $materia = $horario->materia_nombre;
            if (!isset($horasPorMateria[$materia])) {
                $horasPorMateria[$materia] = 0;
            }
            $horasPorMateria[$materia] += $horasClase;
        }

        return [
            'total_horas' => $totalHoras,
            'total_clases' => $horarios->count(),
            'materias_dictadas' => $horarios->pluck('materia_nombre')->unique()->count(),
            'horas_por_dia' => $horasPorDia,
            'horas_por_materia' => $horasPorMateria,
            'horarios' => $horarios->toArray()
        ];
    }

    /**
     * Calcular resumen simple de horas
     */
    public function calcularResumenHoras($maestroId, $periodoId)
    {
        $horarios = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->get();

        $horasPorDia = [
            'Lunes' => 0,
            'Martes' => 0,
            'Miercoles' => 0,
            'Jueves' => 0,
            'Viernes' => 0
        ];

        $totalHoras = 0;
        
        foreach ($horarios as $horario) {
            $dias = $horario->dias ?? [];
            $duracion = $horario->duracion_horas ?? 1;
            
            foreach ($dias as $dia) {
                if (isset($horasPorDia[$dia])) {
                    $horasPorDia[$dia] += $duracion;
                    $totalHoras += $duracion;
                }
            }
        }

        return [
            'total_horas' => $totalHoras,
            'horas_por_dia' => $horasPorDia,
            'total_materias' => $horarios->groupBy('materia_nombre')->count()
        ];
    }

    /**
     * 🔥 NUEVO: Obtener materias únicas de un maestro
     */
    public function obtenerMateriasMaestro($maestroId, $periodoId)
    {
        return Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->pluck('materia_nombre')
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * 🔥 NUEVO: Verificar conflictos de horarios
     */
    public function verificarConflictos($maestroId, $periodoId, $dias, $horarioInicio, $horarioFin, $excluirId = null)
    {
        $query = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId);
        
        if ($excluirId) {
            $query->where('id', '!=', $excluirId);
        }
        
        $horariosExistentes = $query->get();
        
        foreach ($horariosExistentes as $horario) {
            $diasExistentes = $horario->dias ?? [];
            
            // Verificar si hay días en común
            $diasComunes = array_intersect($dias, $diasExistentes);
            
            if (!empty($diasComunes)) {
                // Verificar conflicto de horarios
                $inicioExistente = strtotime($horario->horario_inicio);
                $finExistente = strtotime($horario->horario_fin);
                $inicioNuevo = strtotime($horarioInicio);
                $finNuevo = strtotime($horarioFin);
                
                // Si los intervalos se superponen
                if (($inicioNuevo < $finExistente) && ($finNuevo > $inicioExistente)) {
                    return [
                        'conflicto' => true,
                        'materia' => $horario->materia_nombre,
                        'dias' => $diasExistentes,
                        'horario' => $horario->horario_inicio . ' - ' . $horario->horario_fin,
                        'horario_existente_inicio' => $horario->horario_inicio,
                        'horario_existente_fin' => $horario->horario_fin
                    ];
                }
            }
        }
        
        return ['conflicto' => false];
    }

    /**
     * 🔥 NUEVO: Obtener horarios agrupados por materia
     */
    public function obtenerHorariosPorMateria($maestroId, $periodoId)
    {
        return Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->get()
            ->groupBy('materia_nombre')
            ->map(function ($horarios) {
                return $horarios->map(function ($horario) {
                    return [
                        'dias' => $horario->dias,
                        'horario' => $horario->horario_inicio . ' - ' . $horario->horario_fin,
                        'aula' => $horario->aula,
                        'grupo' => $horario->grupo,
                        'duracion_horas' => $horario->duracion_horas
                    ];
                });
            })
            ->toArray();
    }

    /**
     * 🔥 NUEVO: Generar horario en formato para vista
     */
    public function generarHorarioVista($maestroId, $periodoId)
    {
        $horarios = Horario::where('maestro_id', $maestroId)
            ->where('periodo_id', $periodoId)
            ->orderBy('horario_inicio')
            ->orderBy('horario_fin')
            ->get();

        $diasSemana = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'];
        $horasDisponibles = ['7-8', '8-9', '9-10', '10-11', '11-12', '12-13', '13-14', '14-15', '15-16', '16-17', '17-18'];
        
        $horarioVista = [];
        
        foreach ($diasSemana as $dia) {
            $horarioVista[$dia] = [];
            foreach ($horasDisponibles as $hora) {
                $horarioVista[$dia][$hora] = null;
            }
        }

        foreach ($horarios as $horario) {
            $dias = $horario->dias ?? [];
            
            // Determinar qué horas individuales cubre este rango
            $horasCubiertas = $this->convertirRangoAHorasIndividuales(
                $horario->horario_inicio,
                $horario->horario_fin
            );
            
            foreach ($dias as $dia) {
                foreach ($horasCubiertas as $hora) {
                    if (isset($horarioVista[$dia][$hora])) {
                        $horarioVista[$dia][$hora] = [
                            'materia' => $horario->materia_nombre,
                            'aula' => $horario->aula,
                            'grupo' => $horario->grupo,
                            'color' => $this->generarColorMateria($horario->materia_nombre),
                            'horario_completo' => $horario->horario_inicio . ' - ' . $horario->horario_fin
                        ];
                    }
                }
            }
        }

        return $horarioVista;
    }

    /**
     * 🔥 NUEVO: Generar color único para materia
     */
    private function generarColorMateria($materia)
    {
        $colores = [
            '0744b6', '0d6efd', '198754', '0dcaf0', 
            '6f42c1', 'fd7e14', '20c997', 'e83e8c',
            '6610f2', '6c757d', 'dc3545', 'ffc107'
        ];
        
        $hash = crc32($materia);
        $index = abs($hash) % count($colores);
        
        return $colores[$index];
    }
}