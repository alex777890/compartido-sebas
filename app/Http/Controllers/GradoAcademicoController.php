<?php

namespace App\Http\Controllers;

use App\Models\Maestro;
use App\Models\GradoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GradoAcademicoController extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo grado académico
     */
    public function create($maestro_id)
    {
        try {
            // Buscar el maestro y cargar sus grados existentes
            $maestro = Maestro::with('gradosAcademicos')->findOrFail($maestro_id);
            
            return view('grados_academicos.create', compact('maestro'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.index')
                             ->with('error', 'Maestro no encontrado.');
        }
    }

    /**
     * Almacena un nuevo grado académico en la base de datos
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'maestro_id' => 'required|exists:maestros,id',
            'nivel' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
            'nombre_titulo' => 'required|string|max:200',
            'cedula_profesional' => 'nullable|string|max:20',
            'fecha_expedicion_cedula' => 'nullable|date|before_or_equal:today',
            'institucion' => 'nullable|string|max:150',
            'ano_obtencion' => 'nullable|integer|min:1900|max:' . (date('Y')),
            'observaciones' => 'nullable|string|max:500',
            'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'maestro_id.required' => 'El ID del maestro es requerido.',
            'maestro_id.exists' => 'El maestro seleccionado no existe.',
            'nivel.required' => 'El nivel académico es requerido.',
            'nivel.in' => 'El nivel académico debe ser válido.',
            'nombre_titulo.required' => 'El nombre del título es requerido.',
            'nombre_titulo.max' => 'El nombre del título no debe exceder los 200 caracteres.',
            'fecha_expedicion_cedula.before_or_equal' => 'La fecha de expedición no puede ser futura.',
            'ano_obtencion.max' => 'El año de obtención no puede ser mayor al año actual.',
            'documento.mimes' => 'El documento debe ser un archivo PDF, JPG, JPEG o PNG.',
            'documento.max' => 'El documento no debe pesar más de 2MB.',
        ]);

        try {
            // Procesar el archivo si se subió
            if ($request->hasFile('documento')) {
                $file = $request->file('documento');
                
                // Generar nombre único para el archivo
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $filePath = $file->storeAs('documentos_grados', $fileName, 'public');
                
                // Verificar que el archivo se guardó correctamente
                if (!$filePath) {
                    throw new \Exception('Error al guardar el archivo en el servidor.');
                }
                
                $validated['documento'] = $filePath;
                $validated['nombre_documento'] = $file->getClientOriginalName();
                
                Log::info('Archivo guardado:', [
                    'ruta' => $filePath,
                    'nombre_original' => $validated['nombre_documento']
                ]);
            } else {
                Log::info('No se subió ningún archivo');
            }

            // Crear el nuevo grado académico
            $grado = GradoAcademico::create($validated);
            
            Log::info('Grado académico creado:', [
                'id' => $grado->id,
                'documento' => $grado->documento,
                'nombre_documento' => $grado->nombre_documento
            ]);

            return redirect()->route('maestros.show', $request->maestro_id)
                             ->with('success', 'Grado académico agregado exitosamente.');
                             
        } catch (\Exception $e) {
            Log::error('Error al guardar grado académico:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                             ->with('error', 'Error al guardar el grado académico: ' . $e->getMessage())
                             ->withInput();
        }
    }

    /**
     * Muestra el formulario para editar un grado académico
     */
    public function edit($id)
    {
        try {
            $grado = GradoAcademico::with('maestro')->findOrFail($id);
            return view('grados_academicos.edit', compact('grado'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.index')
                             ->with('error', 'Grado académico no encontrado.');
        }
    }

    /**
     * Actualiza un grado académico en la base de datos
     */
    public function update(Request $request, $id)
    {
        try {
            $grado = GradoAcademico::findOrFail($id);

            $validated = $request->validate([
                'nivel' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
                'nombre_titulo' => 'required|string|max:200',
                'cedula_profesional' => 'nullable|string|max:20',
                'fecha_expedicion_cedula' => 'nullable|date|before_or_equal:today',
                'institucion' => 'nullable|string|max:150',
                'ano_obtencion' => 'nullable|integer|min:1900|max:' . (date('Y')),
                'observaciones' => 'nullable|string|max:500',
                'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ], [
                'fecha_expedicion_cedula.before_or_equal' => 'La fecha de expedición no puede ser futura.',
                'ano_obtencion.max' => 'El año de obtención no puede ser mayor al año actual.',
                'documento.mimes' => 'El documento debe ser un archivo PDF, JPG, JPEG o PNG.',
                'documento.max' => 'El documento no debe pesar más de 2MB.',
            ]);

            // Procesar el archivo si se subió uno nuevo
            if ($request->hasFile('documento')) {
                // Eliminar el archivo anterior si existe
                if ($grado->documento && Storage::disk('public')->exists($grado->documento)) {
                    Storage::disk('public')->delete($grado->documento);
                }
                
                $file = $request->file('documento');
                $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $filePath = $file->storeAs('documentos_grados', $fileName, 'public');
                
                $validated['documento'] = $filePath;
                $validated['nombre_documento'] = $file->getClientOriginalName();
            }

            $grado->update($validated);

            return redirect()->route('maestros.show', $grado->maestro_id)
                             ->with('success', 'Grado académico actualizado exitosamente.');
                             
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.index')
                             ->with('error', 'Grado académico no encontrado.');
        } catch (\Exception $e) {
            Log::error('Error al actualizar grado académico:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                             ->with('error', 'Error al actualizar el grado académico: ' . $e->getMessage())
                             ->withInput();
        }
    }

    /**
     * Elimina un grado académico de la base de datos
     */
    public function destroy($id)
    {
        try {
            $grado = GradoAcademico::findOrFail($id);
            
            // Eliminar el archivo asociado si existe
            if ($grado->documento && Storage::disk('public')->exists($grado->documento)) {
                Storage::disk('public')->delete($grado->documento);
            }
            
            $maestro_id = $grado->maestro_id;
            $grado->delete();

            return redirect()->route('maestros.show', $maestro_id)
                             ->with('success', 'Grado académico eliminado exitosamente.');
                             
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.index')
                             ->with('error', 'Grado académico no encontrado.');
        }
    }

    /**
     * Descarga el documento de un grado académico
     */
    public function download($id)
    {
        try {
            $grado = GradoAcademico::findOrFail($id);
            
            if (!$grado->documento) {
                return redirect()->back()->with('error', 'No hay documento disponible para descargar.');
            }
            
            if (!Storage::disk('public')->exists($grado->documento)) {
                return redirect()->back()->with('error', 'El documento no se encuentra en el servidor.');
            }
            
            return Storage::disk('public')->download($grado->documento, $grado->nombre_documento);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Grado académico no encontrado.');
        } catch (\Exception $e) {
            Log::error('Error al descargar documento:', [
                'grado_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()->with('error', 'Error al descargar el documento: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el documento de un grado académico
     */
    public function showDocument($id)
    {
        try {
            $grado = GradoAcademico::findOrFail($id);
            
            if (!$grado->documento) {
                return redirect()->back()->with('error', 'No hay documento disponible.');
            }
            
            if (!Storage::disk('public')->exists($grado->documento)) {
                return redirect()->back()->with('error', 'El documento no se encuentra en el servidor.');
            }
            
            $filePath = Storage::disk('public')->path($grado->documento);
            $mimeType = Storage::disk('public')->mimeType($grado->documento);
            
            return response()->file($filePath, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $grado->nombre_documento . '"'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al mostrar documento:', [
                'grado_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return redirect()->back()->with('error', 'Error al mostrar el documento: ' . $e->getMessage());
        }
    }

    /**
     * Muestra la vista principal de grados académicos para maestros
     */
    public function indexMaestro()
    {
        try {
            // Obtener el maestro autenticado
            $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
            
            // Cargar grados académicos del maestro
            $gradosAcademicos = $maestro->gradosAcademicos()->orderBy('nivel', 'desc')->get();
            
            return view('grados_academicos.create_maestros', compact(
                'maestro', 
                'gradosAcademicos'
            ));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('home')
                            ->with('error', 'No se encontró el perfil de maestro.');
        }
    }

    /**
     * Muestra el formulario para crear un nuevo grado académico (para maestros)
     */
    public function createMaestro()
    {
        try {
            // Obtener el maestro autenticado
            $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
            
            // También obtener los grados existentes para mostrar en la misma vista
            $gradosAcademicos = $maestro->gradosAcademicos()->orderBy('nivel', 'desc')->get();
            
            return view('grados_academicos.create_maestros', compact(
                'maestro', 
                'gradosAcademicos'
            ));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('home')
                            ->with('error', 'No se encontró el perfil de maestro.');
        }
    }

    /**
     * Almacena un nuevo grado académico (para maestros)
     */
    public function storeMaestro(Request $request)
    {
        try {
            // Validación
            $validated = $request->validate([
                'maestro_id' => 'required|exists:maestros,id',
                'nivel' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
                'nombre_titulo' => 'required|string|max:255',
                'institucion' => 'nullable|string|max:255',
                'ano_obtencion' => 'nullable|integer|min:1900|max:' . date('Y'),
                'cedula_profesional' => 'nullable|string|max:50',
                'fecha_expedicion_cedula' => 'nullable|date|before_or_equal:today',
                'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'observaciones' => 'nullable|string|max:500',
            ]);

            // Verificar que el maestro pertenezca al usuario autenticado
            $maestro = Maestro::where('id', $request->maestro_id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

            $grado = new GradoAcademico($validated);

            // Subir documento si existe
            if ($request->hasFile('documento')) {
                $path = $request->file('documento')->store('grados_academicos', 'public');
                $grado->documento = $path;
            }

            $maestro->gradosAcademicos()->save($grado);

            // IMPORTANTE: Redirigir a la ruta de maestro, no a la de admin
            return redirect()->route('maestros.grados.index')
                            ->with('success', 'Grado académico registrado exitosamente.');
                            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('maestros.grados.index')
                            ->withErrors($e->validator)
                            ->withInput();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.grados.index')
                            ->with('error', 'No tienes permiso para realizar esta acción.');
        } catch (\Exception $e) {
            return redirect()->route('maestros.grados.index')
                            ->with('error', 'Error al guardar el grado académico: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar un grado académico (para maestros)
     */
    public function editMaestro($id)
    {
        try {
            // Obtener el maestro autenticado
            $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
            
            // Buscar el grado académico que pertenezca a este maestro
            $grado = GradoAcademico::where('maestro_id', $maestro->id)
                                  ->findOrFail($id);
            
            return view('grados_academicos.edit_maestros', compact('grado', 'maestro'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.grados.index')
                             ->with('error', 'Grado académico no encontrado o no tienes permisos para editarlo.');
        }
    }

    /**
     * Actualiza un grado académico (para maestros)
     */
    public function updateMaestro(Request $request, $id)
    {
        try {
            // Validación
            $validated = $request->validate([
                'nivel' => 'required|in:Licenciatura,Especialidad,Maestría,Doctorado',
                'nombre_titulo' => 'required|string|max:255',
                'institucion' => 'nullable|string|max:255',
                'ano_obtencion' => 'nullable|integer|min:1900|max:' . date('Y'),
                'cedula_profesional' => 'nullable|string|max:50',
                'fecha_expedicion_cedula' => 'nullable|date|before_or_equal:today',
                'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'observaciones' => 'nullable|string|max:500',
            ]);

            // Obtener el maestro autenticado
            $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
            
            // Buscar el grado académico que pertenezca a este maestro
            $grado = GradoAcademico::where('maestro_id', $maestro->id)
                                  ->findOrFail($id);

            // Subir nuevo documento si existe
            if ($request->hasFile('documento')) {
                // Eliminar documento anterior si existe
                if ($grado->documento && Storage::disk('public')->exists($grado->documento)) {
                    Storage::disk('public')->delete($grado->documento);
                }
                
                $path = $request->file('documento')->store('grados_academicos', 'public');
                $validated['documento'] = $path;
            }

            $grado->update($validated);

            return redirect()->route('maestros.grados.index')
                            ->with('success', 'Grado académico actualizado exitosamente.');
                            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('maestros.grados.edit', $id)
                            ->withErrors($e->validator)
                            ->withInput();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.grados.index')
                             ->with('error', 'Grado académico no encontrado o no tienes permisos para editarlo.');
        }
    }

    /**
     * Elimina un grado académico (para maestros)
     */
    public function destroyMaestro($id)
    {
        try {
            // Obtener el maestro autenticado
            $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
            
            // Buscar el grado académico que pertenezca a este maestro
            $grado = GradoAcademico::where('maestro_id', $maestro->id)
                                  ->findOrFail($id);
            
            // Eliminar el archivo asociado si existe
            if ($grado->documento && Storage::disk('public')->exists($grado->documento)) {
                Storage::disk('public')->delete($grado->documento);
            }
            
            $grado->delete();

            return redirect()->route('maestros.grados.index')
                             ->with('success', 'Grado académico eliminado exitosamente.');
                             
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('maestros.grados.index')
                             ->with('error', 'Grado académico no encontrado o no tienes permisos para eliminarlo.');
        }
    }
    /**
 * Muestra el documento de un grado académico (para maestros)
 */
public function showDocumentMaestro($id)
{
    try {
        // Obtener el maestro autenticado
        $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
        
        // Buscar el grado académico que pertenezca a este maestro
        $grado = GradoAcademico::where('maestro_id', $maestro->id)
                              ->findOrFail($id);
        
        if (!$grado->documento) {
            return redirect()->back()->with('error', 'No hay documento disponible.');
        }
        
        if (!Storage::disk('public')->exists($grado->documento)) {
            return redirect()->back()->with('error', 'El documento no se encuentra en el servidor.');
        }
        
        $filePath = Storage::disk('public')->path($grado->documento);
        $mimeType = Storage::disk('public')->mimeType($grado->documento);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . ($grado->nombre_documento ?? 'documento') . '"'
        ]);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('maestros.grados.index')
                         ->with('error', 'Documento no encontrado o no tienes permisos para verlo.');
    } catch (\Exception $e) {
        Log::error('Error al mostrar documento:', [
            'grado_id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('maestros.grados.index')
                         ->with('error', 'Error al mostrar el documento.');
    }
}

/**
 * Descarga el documento de un grado académico (para maestros)
 */
public function downloadDocumentMaestro($id)
{
    try {
        // Obtener el maestro autenticado
        $maestro = Maestro::where('user_id', auth()->id())->firstOrFail();
        
        // Buscar el grado académico que pertenezca a este maestro
        $grado = GradoAcademico::where('maestro_id', $maestro->id)
                              ->findOrFail($id);
        
        if (!$grado->documento) {
            return redirect()->back()->with('error', 'No hay documento disponible para descargar.');
        }
        
        if (!Storage::disk('public')->exists($grado->documento)) {
            return redirect()->back()->with('error', 'El documento no se encuentra en el servidor.');
        }
        
        $nombreDescarga = $grado->nombre_documento ?? 'documento_' . $grado->id . '.pdf';
        
        return Storage::disk('public')->download($grado->documento, $nombreDescarga);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('maestros.grados.index')
                         ->with('error', 'Documento no encontrado o no tienes permisos para descargarlo.');
    } catch (\Exception $e) {
        Log::error('Error al descargar documento:', [
            'grado_id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('maestros.grados.index')
                         ->with('error', 'Error al descargar el documento.');
    }
}
}