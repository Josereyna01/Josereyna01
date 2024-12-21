<?php

namespace App\Http\Controllers;
use App\Models\Seguro;
use App\Models\Afiliacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;  // Asegúrate de importar el facade de Auth
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

class SegurosController extends Controller
{
    public function index()
    {
        $seguros = Seguro::all();
        
        $afiliaciones = Afiliacion::with('user')  // Eager loading de la relación 'user'
            ->where('tramito_seguro', 'SI')       // Filtramos solo por los que tramitaron seguro
            ->orderBy('id', 'desc')               // Ordenamos por ID de forma descendente
            ->paginate(100);                         // Paginación con 10 resultados por página
        // Calcular la diferencia de días entre 'timestamp_tramito_seguro' y la fecha actual
        foreach ($afiliaciones as $afiliacion) {
            // Convierte ambas fechas a objetos Carbon
            $fechaTramito = Carbon::parse($afiliacion->timestamp_tramito_seguro);
            $fechaActual = Carbon::now(); 
            // Almacenar la diferencia de días en la variable 'vencimiento'
            $afiliacion->vencimiento = $fechaTramito->diffInDays($fechaActual);
        }

        foreach ($seguros as $seguro) {
            // Convierte ambas fechas a objetos Carbon
            $fechaTramito = Carbon::parse($afiliacion->timestamp_tramito_seguro_seguro);
            $fechaActual = Carbon::now(); 
            // Almacenar la diferencia de días en la variable 'vencimiento'
            $seguro->vencimiento = $fechaTramito->diffInDays($fechaActual);
        }
    
        return view('seguros.index', compact('afiliaciones', 'seguros'));  // Asegúrate de pasar 'seguros' también
    }
    
    public function pago($id)
    {
        // Intentar buscar la afiliación por ID
        $afiliacion = Afiliacion::find($id);
    
        // Si no se encuentra como afiliación, buscar como seguro
        if (!$afiliacion) {
            $seguro = Seguro::findOrFail($id);
            return view('seguros.pago', compact('seguro'));
        }
    
        // Si se encuentra la afiliación, pasar los datos de la afiliación
        return view('seguros.pago', compact('afiliacion'));
    }
    
    public function edit($id)
    {
        // Buscar la afiliación que corresponde al ID proporcionado
        $afiliacion = Afiliacion::findOrFail($id);
        $seguro = Seguro::findOrFail($id);

        // Pasar los datos de la afiliación a la vista
        return view('seguros.edit', compact('seguro', 'afiliacion'));
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'tipo_seguro_seguro' => 'required|string|max:255',
            'tramito_seguro_seguro' => 'nullable|string|max:255',
            'descripcion_seguro_seguro' => 'nullable|string|max:255',
            'no_poliza_seguro' => 'required|string|max:255',
            'nombre_seguro' => 'required|string|max:255',
            'ap_paterno_seguro' => 'required|string|max:255',
            'ap_materno_seguro' => 'required|string|max:255',
            'telefono_seguro' => 'required|numeric', 
            'placa_seguro' => 'required|string|max:255',
            'modelo_seguro' => 'required|numeric', 
            'marca_seguro' => 'required|string|max:255',
            'tipo_seguro' => 'required|string|max:255',
            'serie_seguro' => 'required|string|max:255',
        ]);
    
        // Primero, verificamos si el seguro o afiliación existe
        $seguro = Seguro::find($id);
        $afiliacion = Afiliacion::find($id);
    
        // Si no se encuentra el seguro ni la afiliación, retornar error
        if (!$seguro && !$afiliacion) {
            return redirect()->route('seguros.index')->with('error', 'Seguro o Afiliación no encontrado.');
        }
    
    
        // Si viene de la tabla `Seguro`, almacenar el comprobante en Seguro
        if ($seguro) {
            // Verificar si se ha subido un nuevo comprobante
            if ($request->hasFile('comprobante')) {
                // Eliminar el archivo anterior si existe
                if ($seguro->comprobante && Storage::exists($seguro->comprobante)) {
                    Storage::delete($seguro->comprobante);
                }
    
                // Guardar el nuevo archivo en el almacenamiento
                $comprobantePath = $request->file('comprobante')->store('comprobantes', 'public');
    
                // Actualizar el campo con la ruta del archivo guardado
                $seguro->comprobante = $comprobantePath;
            }

            // Solo asigna el timestamp si el campo 'tramito_seguro' es 'SI'
            if ($request->tramito_seguro_seguro === 'SI' && !$seguro->timestamp_tramito_seguro_seguro) {
                // Solo asignar si no tiene ya un valor
                $seguro->timestamp_tramito_seguro_seguro = now(); // Usa la función now() de Laravel para obtener el timestamp actual
            }
    
            // Actualizamos el resto de campos del seguro
            $seguro->update([
                'tipo_seguro_seguro' => $request->tipo_seguro_seguro,
                'tramito_seguro_seguro' => $request->tramito_seguro_seguro,
                'descripcion_seguro_seguro' => $request->descripcion_seguro_seguro,
                'no_poliza_seguro' => $request->no_poliza_seguro,
                'nombre_seguro' => $request->nombre_seguro,
                'ap_paterno_seguro' => $request->ap_paterno_seguro,
                'ap_materno_seguro' => $request->ap_materno_seguro,
                'telefono_seguro' => $request->telefono_seguro,
                'placa_seguro' => $request->placa_seguro,
                'modelo_seguro' => $request->modelo_seguro,
                'marca_seguro' => $request->marca_seguro,
                'tipo_seguro' => $request->tipo_seguro,
                'serie_seguro' => $request->serie_seguro,
            ]);
        }
    
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('seguros.index')->with('success', 'Seguro actualizado correctamente.');
    }
    

    public function mostrarFormulario()
    {
        return view('seguros.create');
    }

    public function crearSeguro(Request $request)
    {
        $validated = $request->validate([
            'tipo_seguro_seguro' => 'required|string|max:255',
            'tramito_seguro_seguro' => 'required|string|max:255',
            'descripcion_seguro_seguro' => 'nullable|string|max:255',
            'no_poliza_seguro' => 'required|string|max:255',
            'nombre_seguro' => 'required|string|max:255',
            'ap_paterno_seguro' => 'required|string|max:255',
            'ap_materno_seguro' => 'required|string|max:255',
            'telefono_seguro' => 'required|numeric', 
            'placa_seguro' => 'required|string|max:255',
            'modelo_seguro' => 'required|numeric', 
            'marca_seguro' => 'required|string|max:255',
            'tipo_seguro' => 'required|string|max:255',
            'serie_seguro' => 'required|string|max:255',

        ]);
    
        // Creación del objeto Seguro
        $seguro = new Seguro; 
        $seguro->tipo_seguro_seguro = $request->tipo_seguro_seguro;
        $seguro->tramito_seguro_seguro = $request->tramito_seguro_seguro;
        $seguro->descripcion_seguro_seguro = $request->descripcion_seguro_seguro;
        $seguro->no_poliza_seguro = $request->no_poliza_seguro;
        $seguro->nombre_seguro = $request->nombre_seguro;
        $seguro->ap_paterno_seguro = $request->ap_paterno_seguro;
        $seguro->ap_materno_seguro = $request->ap_materno_seguro;
        $seguro->telefono_seguro = $request->telefono_seguro;
        $seguro->placa_seguro = $request->placa_seguro;
        $seguro->modelo_seguro = $request->modelo_seguro;
        $seguro->marca_seguro = $request->marca_seguro;
        $seguro->tipo_seguro = $request->tipo_seguro;
        $seguro->serie_seguro = $request->serie_seguro;

        // Asignar un timestamp si tramito_seguro es "SI"
        if ($request->tramito_seguro_seguro === 'SI') {
            $seguro->timestamp_tramito_seguro_seguro = now(); // Usa la función now() de Laravel para obtener el timestamp actual
        }
        $seguro->user_id = Auth::user()->id;

        $seguro->save();
    
        return redirect()->route('seguros.index')->with('success', 'seguro creado con éxito.');
    }

    public function updatePago(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'comprobante' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);
    
        // Intentar buscar la afiliación
        $afiliacion = Afiliacion::find($id);
        // Intentar buscar el seguro
        $seguro = Seguro::find($id);
    
        // Verificar si se encuentra la afiliación
        if ($afiliacion) {
            Log::info('Afiliación encontrada', ['afiliacion' => $afiliacion]);
    
            // Si se subió un nuevo archivo de comprobante
            if ($request->hasFile('comprobante')) {
                Log::info('Archivo recibido para afiliación', ['file' => $request->file('comprobante')]);
    
                // Eliminar el archivo anterior si existe
                if ($afiliacion->comprobante && Storage::exists($afiliacion->comprobante)) {
                    Storage::delete($afiliacion->comprobante);
                }
    
                // Guardar el nuevo archivo en el almacenamiento
                $comprobantePath = $request->file('comprobante')->store('comprobantes', 'public');
    
                // Actualizar el campo con la ruta del archivo guardado
                $afiliacion->comprobante = $comprobantePath;
            }
    
            // Guardar los cambios en la afiliación
            $afiliacion->save();
        } else {
            Log::info('No se encontró la afiliación con ID: ' . $id);
            return redirect()->route('seguros.index')->with('error', 'No se encontró la afiliación.');
        }
    
        // Verificar si se encuentra el seguro
        if ($seguro) {
            Log::info("Seguro encontrado con ID: $id");
    
            // Si se subió un nuevo archivo de comprobante
            if ($request->hasFile('comprobante')) {
                Log::info('Archivo recibido para seguro', ['file' => $request->file('comprobante')]);
    
                // Eliminar el archivo anterior si existe
                if ($seguro->comprobante && Storage::exists($seguro->comprobante)) {
                    Storage::delete($seguro->comprobante);
                }
    
                // Guardar el nuevo archivo en el almacenamiento
                $comprobantePath = $request->file('comprobante')->store('comprobantes', 'public');
    
                // Actualizar el campo con la ruta del archivo guardado
                $seguro->comprobante = $comprobantePath;
            }
    
            // Guardar los cambios en el seguro
            $seguro->save();
    
            return redirect()->route('seguros.index')->with('success', 'Seguro actualizado correctamente.');
        } else {
            Log::info('No se encontró el seguro con ID: ' . $id);
            return redirect()->route('seguros.index')->with('error', 'No se encontró el seguro.');
        }
    }
    
    
}
