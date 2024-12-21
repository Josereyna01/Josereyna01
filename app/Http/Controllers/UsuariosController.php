<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Mail\UserMail; 
use Illuminate\Support\Facades\Mail;
use App\Models\User; 
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Notifications\NombreDeTuNotificacion;


class UsuariosController extends Controller
{
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->paginate(20);
        return view('usuarios.index', compact('users'));
    }
    public function edit($id)
    {
        $sucursales = Sucursal::all();
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado');
        }

        // Formatea el número de celular antes de pasar a la vista
        $user->formatted_celular = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '($1) $2-$3', $user->celular);

        return view('usuarios.edit', compact('user', 'sucursales'));
    }

        
    
    public function mostrarFormulario()
    {
        $roles = Role::all();
        $sucursales = Sucursal::all();
        return view('usuarios.create',  compact('sucursales', 'roles'));
        
    }   

    public function crearUsuario(Request $request)
    {
        $roles = \Spatie\Permission\Models\Role::all()->pluck('name');

        $messages = [
            'name.required' => 'El campo Nombres es obligatorio.',
            'apellido_paterno.required' => 'El campo Apellido Paterno es obligatorio.',
            'apellido_materno.required' => 'El campo Apellido Materno es obligatorio.',
            'correo.required' => 'El campo Correo es obligatorio.',
            'sucursal.required' => 'El campo Sucursal es obligatorio.',
            'celular.required' => 'El campo Celular es obligatorio.',
            'password.required' => 'El campo Contraseña es obligatorio.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            // ... puedes agregar más mensajes personalizados aquí
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'celular' => 'required|max:255',
            'sucursal' => 'required|string|max:255',
            'estatus' => 'nullable|in:Activo,Inactivo',
            'rol' => ['required', Rule::in($roles)],
            'password' => 'required|min:8|confirmed',
        ], $messages);

        
        // Creación del usuario
        $user = new User; 
        $user->name = $request->name;
        $user->apellido_paterno = $request->apellido_paterno;
        $user->apellido_materno = $request->apellido_materno;
        $user->email = $request->email;
        $user->celular = preg_replace('/\D/', '', $request->celular);
        $user->sucursal = $request->sucursal;
        $user->estatus = $request->estatus;
        $user->assignRole($request->rol);
        $user->password = bcrypt($request->password);
        $user->save();

        // Redirección con mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    
    public function update(Request $request, $id)
    {
        $roles = \Spatie\Permission\Models\Role::all()->pluck('name');

        // Validación de datos (esto es un ejemplo básico, puedes agregar más reglas según lo necesites)
        $validator = $request->validate([
            'name' => 'required|max:255',
            'apellido_paterno' => 'required|max:255',
            'apellido_materno' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,  // Asegura que el correo electrónico sea único, excluyendo el ID del usuario actual
            'celular' => 'required', // Asegura que el celular sea un número y tenga exactamente 10 dígitos
            'sucursal' => 'required|max:255',
            'estatus' => 'required|in:Activo,Inactivo',
            'rol' => ['required', Rule::in($roles)],
        ], [
            'celular.required' => 'El campo Celular es obligatorio.',
            'celular.digits' => 'El campo Celular debe tener exactamente 10 dígitos.',
        ]);

        // Busca el usuario por ID
        $user = User::find($id);

        // Si el usuario no se encuentra, redirige con un mensaje de error (puedes manejar esto de diferentes maneras)
        if (!$user) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }

        // Procesa el número de celular para quitar cualquier caracter no numérico
        $celular = preg_replace('/\D/', '', $request->celular);

        // Actualiza el usuario con los datos del formulario
        $user->update([
            'name' => $request->name,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'celular' => $celular,
            'sucursal' => $request->sucursal,
            'estatus' => $request->estatus,
        ]);

        $user->syncRoles($request->rol);

        // Redirige de vuelta a la página de lista o a donde prefieras con un mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }


    public function buscar(Request $request) {
        $busqueda = $request->get('busqueda');
    
        $users = User::where('name', 'LIKE', "%$busqueda%")
                             ->orWhere('apellido_paterno', 'LIKE', "%$busqueda%")
                             ->orWhere('apellido_materno', 'LIKE', "%$busqueda%")
                             ->orWhere('sucursal', 'LIKE', "%$busqueda%")
                             ->orWhere('estatus', 'LIKE', "%$busqueda%")
                             ->orWhere('email', 'LIKE', "%$busqueda%")
                             ->orWhere('celular', 'LIKE', "%$busqueda%")

                             ->paginate(10);
    
        return view('usuarios.index', compact('users'));
        }
}
