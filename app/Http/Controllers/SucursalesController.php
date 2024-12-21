<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalesController extends Controller
{
    public function index()
    {
        
        $sucursales = Sucursal::orderBy('id', 'desc')->paginate(4);
        return view('sucursales.index', compact('sucursales'));
    }

    public function edit($id)
    {
        $sucursal = Sucursal::find($id);
        
        if (!$sucursal) {
            return redirect()->route('sucursales.index')->with('error', 'Sucursal no encontrado');
        }
    
        return view('sucursales.edit', compact('sucursal'));
    }
    
    
    public function mostrarFormulario()
    {
        return view('sucursales.create');
    }

    public function crearSucursal(Request $request)
    {
        $messages = [
            'nombre.required' => 'El campo nombre de sucursal es obligatorio.',
            'direccion.required' => 'El campo direccion es obligatorio.',
            'tipo_sucursal.required' => 'El campo tipo de sucursal es obligatorio.',
            'estatus.required' => 'El campo estatus es obligatorio.',
            'comentarios.required' => 'El campo comentarios es obligatorio.',
            'celular.required' => 'El campo Celular es obligatorio.',

            // ... puedes agregar más mensajes personalizados aquí
        ];

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'tipo_sucursal' => 'required|string|max:255',
            'estatus' => 'required|string|max:255',
            'comentarios' => 'required|string|max:255',
            'celular' => 'required|max:255',
        ], $messages);

        // Creación del sucursal
        $sucursal = new Sucursal; 
        $sucursal->nombre = $request->nombre;
        $sucursal->direccion = $request->direccion;
        $sucursal->tipo_sucursal = $request->tipo_sucursal;
        $sucursal->estatus = $request->estatus;
        $sucursal->comentarios = $request->comentarios;
        $sucursal->celular = preg_replace('/\D/', '', $request->celular);



        $sucursal->save();

        return redirect()->route('sucursales.index')->with('success', 'Sucursal creado con éxito y se ha enviado un correo con detalles de inicio de sesión.');
    }

    public function update(Request $request, $id)
    {
        // Validación de datos (esto es un ejemplo básico, puedes agregar más reglas según lo necesites)
        $validator = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'tipo_sucursal' => 'required|string|max:255',
            'estatus' => 'required|string|max:255',
            'comentarios' => 'required|string|max:255',
            'celular' => 'required|max:255',
        ], [
            'nombre.required' => 'El campo nombre de sucursal es obligatorio.',
            'direccion.required' => 'El campo direccion es obligatorio.',
            'tipo_sucursal.required' => 'El campo tipo de sucursal es obligatorio.',
            'estatus.required' => 'El campo estatus es obligatorio.',
            'comentarios.required' => 'El campo comentarios es obligatorio.',
            'celular.required' => 'El campo Celular es obligatorio.',
        ]);

        // Busca el sucursal por ID
        $sucursal = Sucursal::find($id);

        // Si el sucursal no se encuentra, redirige con un mensaje de error (puedes manejar esto de diferentes maneras)
        if (!$sucursal) {
            return redirect()->route('sucursales.index')->with('error', 'Sucursal no encontrado.');
        }

        // Actualiza el sucursal con los datos del formulario
        $sucursal->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'tipo_sucursal' => $request->tipo_sucursal,
            'estatus' => $request->estatus,
            'comentarios' => $request->comentarios,
            'celular' => $request->celular,
        ]);


        // Redirige de vuelta a la página de lista o a donde prefieras con un mensaje de éxito
        return redirect()->route('sucursales.index')->with('success', 'Sucursal actualizado con éxito.');
    }
    public function buscar(Request $request) {
        $busqueda = $request->get('busqueda');
    
        $sucursales = Sucursal::where('nombre', 'LIKE', "%$busqueda%")
                             ->orWhere('direccion', 'LIKE', "%$busqueda%")
                             ->orWhere('tipo_sucursal', 'LIKE', "%$busqueda%")
                             ->orWhere('estatus', 'LIKE', "%$busqueda%")
                             ->paginate(10);
    
        return view('sucursales.index', compact('sucursales'));
    }
    
}
