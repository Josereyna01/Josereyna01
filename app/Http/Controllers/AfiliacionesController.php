<?php

namespace App\Http\Controllers;
use App\Models\Afiliacion;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AfiliacionesController extends Controller
{
    // En tu controlador
    public function index()
    {
        $afiliaciones = Afiliacion::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('afiliaciones.index', compact('afiliaciones'));
    }


    public function edit($id)
    {
        $afiliacion = Afiliacion::find($id);
        
        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrado');
        }
    
        return view('afiliaciones.edit', compact('afiliacion'));
    }
    
    public function vistaConfirmacion($id)
    {
        $afiliacion = Afiliacion::find($id);

        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }

        return view('afiliaciones.confirmacion', compact('afiliacion'));
    }

    public function mostrarFormulario()
    {
        return view('afiliaciones.create');
    }

    public function crearAfiliacion(Request $request)
    {
        $messages = [
            'nombre_uno.required' => 'El campo Nombre Uno es obligatorio.',
            'ap_paterno_uno.required' => 'El campo Apellido Paterno Uno es obligatorio.',
            'ap_materno_uno.required' => 'El campo Apellido Materno Uno es obligatorio.',
            'tel_uno.required' => 'El campo Telefono Uno es obligatorio.',
            'nombre_dos.required' => 'El campo Nombre Dos es obligatorio.',
            'ap_paterno_dos.required' => 'El campo Apellido Paterno Dos es obligatorio.',
            'ap_materno_dos.required' => 'El campo Apellido Materno Dos es obligatorio.',
            'tel_dos.required' => 'El campo Telefono Dos es obligatorio.',
            'nombre_tres.required' => 'El campo Nombre Tres es obligatorio.',
            'ap_paterno_tres.required' => 'El campo Apellido Paterno Tres es obligatorio.',
            'ap_materno_tres.required' => 'El campo Apellido Materno Tres es obligatorio.',
            'tel_tres.required' => 'El campo Telefono Tres es obligatorio.',
            'seccion.required' => 'El campo Seccion es obligatorio.',
            'municipio.required' => 'El campo Municipio es obligatorio.',
            'colonia.required' => 'El campo Colonia es obligatorio.',
            'calle.required' => 'El campo Calle es obligatorio.',
            'no_casa.required' => 'El campo No. Casa es obligatorio.',
            'placa.required' => 'El campo Numero de Placa es obligatorio.',
            'modelo.required' => 'El campo Modelo es obligatorio.',
            'marca.required' => 'El campo Marca es obligatorio.',
            'tipo.required' => 'El campo Tipo es obligatorio.',
            'color.required' => 'El campo Color es obligatorio.',
            'serie.required' => 'El campo Serie es obligatorio.',
                
            // ... puedes agregar más mensajes personalizaDos aquí
        ];
    
        $validated = $request->validate([
            'nombre_uno' => 'required|string|max:255',
            'ap_paterno_uno' => 'required|string|max:255',
            'ap_materno_uno' => 'required|string|max:255',
            'tel_uno' => 'required|integer',
            'nombre_dos' => 'nullable|string|max:255',
            'ap_paterno_dos' => 'nullable|string|max:255',
            'ap_materno_dos' => 'nullable|string|max:255',
            'tel_dos' => 'nullable|integer',
            'nombre_tres' => 'nullable|string|max:255',
            'ap_paterno_tres' => 'nullable|string|max:255',
            'ap_materno_tres' => 'nullable|string|max:255',
            'tel_tres' => 'nullable|integer',
            'seccion' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'colonia' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'no_casa' => 'required|string|max:255',
            'placa' => 'required|string|max:255',
            'modelo' => 'required|numeric',
            'marca' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'metodo_pago' => 'required|string|max:255',
            'tramito_seguro' => 'nullable|string|max:255',
            'tipo_seguro' => 'nullable|string|max:255',
            'descripcion_seguro' => 'nullable|string|max:255',
            'no_poliza' => 'nullable|numeric',
        ], $messages);
    
        // Creación del objeto Afiliacion
        $afiliacion = new Afiliacion; 
        $afiliacion->nombre_uno = $request->nombre_uno;
        $afiliacion->ap_paterno_uno = $request->ap_paterno_uno;
        $afiliacion->ap_materno_uno = $request->ap_materno_uno;
        $afiliacion->tel_uno = $request->tel_uno;
        $afiliacion->nombre_dos = $request->nombre_dos ?? null;
        $afiliacion->ap_paterno_dos = $request->ap_paterno_dos ?? null;
        $afiliacion->ap_materno_dos = $request->ap_materno_dos ?? null;
        $afiliacion->tel_dos = $request->tel_dos ?? null;
        $afiliacion->nombre_tres = $request->nombre_tres ?? null;
        $afiliacion->ap_paterno_tres = $request->ap_paterno_tres ?? null;
        $afiliacion->ap_materno_tres = $request->ap_materno_tres ?? null;
        $afiliacion->tel_tres = $request->tel_tres ?? null;
        $afiliacion->seccion = $request->seccion;
        $afiliacion->municipio = $request->municipio;
        $afiliacion->colonia = $request->colonia;
        $afiliacion->calle = $request->calle;
        $afiliacion->no_casa = $request->no_casa;
        $afiliacion->placa = $request->placa;
        $afiliacion->modelo = $request->modelo;
        $afiliacion->marca = $request->marca;
        $afiliacion->tipo = $request->tipo;
        $afiliacion->color = $request->color;
        $afiliacion->serie = $request->serie;
        $afiliacion->metodo_pago = $request->metodo_pago;
        $afiliacion->tramito_seguro = $request->tramito_seguro;
        $afiliacion->tipo_seguro = $request->tipo_seguro ?? null;
        $afiliacion->descripcion_seguro = $request->descripcion_seguro ?? null;
        $afiliacion->no_poliza = $request->no_poliza ?? null;

        // Asignar un timestamp si tramito_seguro es "SI"
        if ($request->tramito_seguro === 'SI') {
            $afiliacion->timestamp_tramito_seguro = now(); // Usa la función now() de Laravel para obtener el timestamp actual
        }

        $afiliacion->user_id = Auth::id(); // Obtener el ID del usuario autenticado

        $afiliacion->save();

        return redirect()->route('afiliaciones.confirmacion', ['id' => $afiliacion->id]);
    }

    public function update(Request $request, $id)
    {
        // Validación de datos (esto es un ejemplo básico, puedes agregar más reglas según lo necesites)
        $request->validate([
            'nombre_uno' => 'required|string|max:255',
            'ap_paterno_uno' => 'required|string|max:255',
            'ap_materno_uno' => 'required|string|max:255',
            'tel_uno' => 'required|integer',
            'nombre_dos' => 'nullable|string|max:255',
            'ap_paterno_dos' => 'nullable|string|max:255',
            'ap_materno_dos' => 'nullable|string|max:255',
            'tel_dos' => 'nullable|integer',
            'nombre_tres' => 'nullable|string|max:255',
            'ap_paterno_tres' => 'nullable|string|max:255',
            'ap_materno_tres' => 'nullable|string|max:255',
            'tel_tres' => 'nullable|integer',
            'seccion' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'colonia' => 'required|string|max:255',
            'calle' => 'required|string|max:255',
            'no_casa' => 'required|string|max:255',
            'placa' => 'required|string|max:255',
            'modelo' => 'required|numeric',
            'marca' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'serie' => 'required|string|max:255',
            'metodo_pago' => 'required|string|max:255',
            'tramito_seguro' => 'nullable|string|max:255',
            'tipo_seguro' => 'nullable|string|max:255',
            'descripcion_seguro' => 'nullable|string|max:255',
            'no_poliza' => 'nullable|numeric',
        ], [
            'nombre_uno.required' => 'El campo Nombre Uno es obligatorio.',
            'ap_paterno_uno.required' => 'El campo Apellido Paterno Uno es obligatorio.',
            'ap_materno_uno.required' => 'El campo Apellido Materno Uno es obligatorio.',
            'tel_uno.required' => 'El campo Telefono Uno es obligatorio.',
            'nombre_dos.required' => 'El campo Nombre Dos es obligatorio.',
            'ap_paterno_dos.required' => 'El campo Apellido Paterno Dos es obligatorio.',
            'ap_materno_dos.required' => 'El campo Apellido Materno Dos es obligatorio.',
            'tel_dos.required' => 'El campo Telefono Dos es obligatorio.',
            'nombre_tres.required' => 'El campo Nombre Tres es obligatorio.',
            'ap_paterno_tres.required' => 'El campo Apellido Paterno Tres es obligatorio.',
            'ap_materno_tres.required' => 'El campo Apellido Materno Tres es obligatorio.',
            'tel_tres.required' => 'El campo Telefono Tres es obligatorio.',
            'municipio.required' => 'El campo Municipio es obligatorio.',
            'seccion.required' => 'El campo Seccion es obligatorio.',
            'colonia.required' => 'El campo Colonia es obligatorio.',
            'calle.required' => 'El campo Calle es obligatorio.',
            'no_casa.required' => 'El campo No. Casa es obligatorio.',
            'placa.required' => 'El campo Numero de Placa es obligatorio.',
            'modelo.required' => 'El campo Modelo es obligatorio.',
            'marca.required' => 'El campo Marca es obligatorio.',
            'tipo.required' => 'El campo Tipo es obligatorio.',
            'color.required' => 'El campo Color es obligatorio.',
            'serie.required' => 'El campo Serie es obligatorio.',
        ]);
    
        // Busca el afiliacion por ID
        $afiliacion = Afiliacion::find($id);
    
        // Si el afiliación no se encuentra, redirige con un mensaje de error
        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }
    
        // Solo asigna el timestamp si el campo 'tramito_seguro' es 'SI'
        if ($request->tramito_seguro === 'SI' && !$afiliacion->timestamp_tramito_seguro) {
            // Solo asignar si no tiene ya un valor
            $afiliacion->timestamp_tramito_seguro = now(); // Usa la función now() de Laravel para obtener el timestamp actual
        }
    
        // Actualiza el afiliación con los datos del formulario
        $afiliacion->update([
            'nombre_uno' => $request->nombre_uno,
            'ap_paterno_uno' => $request->ap_paterno_uno,
            'ap_materno_uno' => $request->ap_materno_uno,
            'tel_uno' => $request->tel_uno,
            'nombre_dos' => $request->nombre_dos,
            'ap_paterno_dos' => $request->ap_paterno_dos,
            'ap_materno_dos' => $request->ap_materno_dos,
            'tel_dos' => $request->tel_dos,
            'nombre_tres' => $request->nombre_tres,
            'ap_paterno_tres' => $request->ap_paterno_tres,
            'ap_materno_tres' => $request->ap_materno_tres,
            'tel_tres' => $request->tel_tres,
            'seccion' => $request->seccion,
            'municipio' => $request->municipio,
            'colonia' => $request->colonia,
            'calle' => $request->calle,
            'no_casa' => $request->no_casa,
            'placa' => $request->placa,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'tipo' => $request->tipo,
            'color' => $request->color,
            'serie' => $request->serie,
            'metodo_pago' => $request->metodo_pago,
            'tramito_seguro' => $request->tramito_seguro,
            'tipo_seguro' => $request->tipo_seguro,
            'descripcion_seguro' => $request->descripcion_seguro,
            'no_poliza' => $request->no_poliza,
        ]);
    
        // Redirige de vuelta a la página de lista o a donde prefieras con un mensaje de éxito
        return redirect()->route('afiliaciones.index')->with('success', 'Afiliacion actualizada con éxito.');
    }
    

    
    public function buscar(Request $request) {
        $busqueda = $request->get('busqueda');
    
        $afiliaciones = Afiliacion::where('nombre_uno', 'LIKE', "%$busqueda%")
                        ->orWhere('ap_paterno_uno', 'LIKE', "%$busqueda%")
                        ->orWhere('ap_materno_uno', 'LIKE', "%$busqueda%")
                        ->orWhere('placa', 'LIKE', "%$busqueda%")
                        ->orWhere('marca', 'LIKE', "%$busqueda%")
                        ->orWhere('seccion', 'LIKE', "%$busqueda%")
                        ->orWhere('modelo', 'LIKE', "%$busqueda%")
                        ->orWhere('tipo', 'LIKE', "%$busqueda%")
                        ->orWhere('serie', 'LIKE', "%$busqueda%")
                        ->paginate(10);

        return view('afiliaciones.index', compact('afiliaciones'));
    }

    public function eliminar($id)
    {
        $afiliacion = Afiliacion::find($id);

        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }

        $afiliacion->delete();

        return redirect()->route('afiliaciones.index')->with('success', 'Afiliacion eliminada con éxito.');
    }

    private function generarPDF($afiliacion)
    {
        // Obtener la instancia de Dompdf
        $dompdf = app(\Dompdf\Dompdf::class);

        // Configurar el tamaño del papel y la orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar la vista Blade a HTML
        $html = view('afiliaciones.pdf', compact('afiliacion'))->render();

        // Cargar el HTML en Dompdf
        $dompdf->loadHtml($html);

        // Construir el nombre del archivo PDF usando campos de la afiliación
        $nombrePDF = $afiliacion->nombre_uno . '_' . $afiliacion->ap_paterno_uno . '_' . $afiliacion->ap_materno_uno . '_' . $afiliacion->placa . '.pdf';
        $nombrePDF = str_replace(' ', '_', $nombrePDF); // Reemplazar espacios con guiones bajos

        // Hacer la renderización final del PDF
        $dompdf->render();

        // Almacenar el PDF en DigitalOcean Spaces
        $rutaPDF = 'pdfs/' . $nombrePDF;
        Storage::disk('do')->put($rutaPDF, $dompdf->output());
        
        // Devolver la ruta del PDF en Spaces
        return $rutaPDF;
    }
    
        public function verPDF($id) 
    {
        // Buscar la afiliación por ID
        $afiliacion = Afiliacion::find($id);

        // Si la afiliación no se encuentra, redirige con un mensaje de error
        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }

        // Obtener la instancia de Dompdf
        $dompdf = app(\Dompdf\Dompdf::class);

        // Configurar el tamaño del papel y la orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar la vista Blade a HTML
        $html = view('afiliaciones.pdf', compact('afiliacion'))->render();

        // Cargar el HTML en Dompdf
        $dompdf->loadHtml($html);

        // Hacer la renderización final del PDF
        $dompdf->render();

        // Obtener el contenido del PDF como una cadena
        $output = $dompdf->output();

        // Devolver una respuesta para mostrar el PDF en el navegador
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="nombre_archivo.pdf"',
        ]);
    }

    
    public function vistaPreviaPDF($id) 
    {
        // Buscar la afiliación por ID
        $afiliacion = Afiliacion::find($id);
    
        // Si la afiliación no se encuentra, redirige con un mensaje de error
        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }
    
        // Genera el PDF y obtén la ruta
        $pdfPath = $this->generarPDF($afiliacion);
    
        // Devuelve una vista previa del PDF en el navegador
        return view('afiliaciones.vista_previa', compact('pdfPath'));
    }
    //PDF pago de seguro
    private function generarPDFs($afiliacion)
    {
        // Obtener la instancia de Dompdf
        $dompdf = app(\Dompdf\Dompdf::class);

        // Configurar el tamaño del papel y la orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar la vista Blade a HTML
        $html = view('afiliaciones.pdf_seguro', compact('seguro'))->render();

        // Cargar el HTML en Dompdf
        $dompdf->loadHtml($html);

        // Construir el nombre del archivo PDF usando campos de la afiliación
        $nombrePDF = $afiliacion->no_poliza . '_' . $afiliacion->nombre_uno . '_' . $afiliacion->ap_paterno_uno . '_' . $afiliacion->ap_materno_uno . '_' . $afiliacion->placa . '.pdf';
        $nombrePDF = str_replace(' ', '_', $nombrePDF); // Reemplazar espacios con guiones bajos

        // Hacer la renderización final del PDF
        $dompdf->render();

        // Almacenar el PDF en DigitalOcean Spaces
        $rutaPDF = 'pdfs/' . $nombrePDF;
        Storage::disk('do')->put($rutaPDF, $dompdf->output());
        
        // Devolver la ruta del PDF en Spaces
        return $rutaPDF;
    }
    
        public function verPDFs($id) 
    {
        // Buscar la afiliación por ID
        $afiliacion = Afiliacion::find($id);

        // Si la afiliación no se encuentra, redirige con un mensaje de error
        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }

        // Obtener la instancia de Dompdf
        $dompdf = app(\Dompdf\Dompdf::class);

        // Configurar el tamaño del papel y la orientación
        $dompdf->setPaper('A4', 'portrait');

        // Renderizar la vista Blade a HTML
        $html = view('afiliaciones.pdf_seguro', compact('afiliacion'))->render();

        // Cargar el HTML en Dompdf
        $dompdf->loadHtml($html);

        // Hacer la renderización final del PDF
        $dompdf->render();

        // Obtener el contenido del PDF como una cadena
        $output = $dompdf->output();

        // Devolver una respuesta para mostrar el PDF en el navegador
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="nombre_archivo.pdf"',
        ]);
    }

    
    public function vistaPreviaPDFs($id) 
    {
        // Buscar la afiliación por ID
        $afiliacion = Afiliacion::find($id);
    
        // Si la afiliación no se encuentra, redirige con un mensaje de error
        if (!$afiliacion) {
            return redirect()->route('afiliaciones.index')->with('error', 'Afiliacion no encontrada.');
        }
    
        // Genera el PDF y obtén la ruta
        $pdfPath = $this->generarPDF($afiliacion);
    
        // Devuelve una vista previa del PDF en el navegador
        return view('afiliaciones.vista_previa', compact('pdfPath'));
    }
    public function decodeVin(Request $request)
    {
        $vin = $request->query('vin');

        $response = Http::get("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/{$vin}", [
            'format' => 'json'
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'No se pudo obtener la información del VIN'], 500);
        }
    }

        // Método para actualizar los datos del seguro
    public function updatePago(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'comprobante' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Buscar la afiliación que corresponde al ID proporcionado
        $afiliacion = Afiliacion::findOrFail($id);


        // Verificar si se ha subido un nuevo comprobante de pago
        if ($request->hasFile('comprobante')) {
            // Eliminar el archivo anterior si existe
            if ($afiliacion->comprobante && Storage::exists($afiliacion->comprobante)) {
                Storage::delete($afiliacion->comprobante);
            }

            // Guardar el nuevo archivo en el almacenamiento
            $comprobantePath = $request->file('comprobante')->store('comprobantes', 'public');

            // Actualizar el campo con la ruta del archivo guardado
            $afiliacion->comprobante = $comprobantePath;
        }

        // Guardar los cambios
        $afiliacion->save();

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('seguros.index')->with('success', 'Seguro actualizado correctamente.');
    }
}