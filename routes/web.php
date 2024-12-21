<?php


use App\Http\Controllers\AfiliacionesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\SegurosController;
use App\Http\Controllers\IndexCatalogosController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;


Route::get('/', function () {
    return view('auth/login');
});


Route::get('/inicio', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('inicio');

Route::group(['middleware' => ['role:Administrador|Oficinista']], function () {
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/edicion/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/usuarios/nuevo', [UsuariosController::class, 'mostrarFormulario'])->name('usuarios.create');
    Route::post('/usuarios/nuevo', [UsuariosController::class, 'crearUsuario'])->name('usuarios.store');
    Route::get('/usuarios/buscar', [UsuariosController::class, 'buscar'])->name('usuarios.buscar');

    Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
    Route::get('/ventas/create', [VentasController::class, 'mostrarFormulario'])->name('ventas.create');
    Route::post('/ventas', [VentasController::class, 'crearVenta'])->name('ventas.store');
    Route::get('/ventas/{id}/edit', [VentasController::class, 'edit'])->name('ventas.edit');
    Route::put('/ventas/{id}', [VentasController::class, 'update'])->name('ventas.update');
    Route::get('/ventas/buscar', [VentasController::class, 'buscar'])->name('ventas.buscar');
    Route::delete('/ventas/{id}', [VentasController::class, 'eliminar'])->name('ventas.eliminar');

    Route::get('/sucursales', [SucursalesController::class, 'index'])->name('sucursales.index');
    Route::get('/sucursales/create', [SucursalesController::class, 'mostrarFormulario'])->name('sucursales.create');
    Route::post('/sucursales', [SucursalesController::class, 'crearSucursal'])->name('sucursales.store');
    Route::get('/sucursales/{id}/edit', [SucursalesController::class, 'edit'])->name('sucursales.edit');
    Route::put('/sucursales/{id}', [SucursalesController::class, 'update'])->name('sucursales.update');
    Route::get('/sucursales/buscar', [SucursalesController::class, 'buscar'])->name('sucursales.buscar');

    Route::get('/afiliaciones', [AfiliacionesController::class, 'index'])->name('afiliaciones.index');
    Route::get('/afiliaciones/create', [AfiliacionesController::class, 'mostrarFormulario'])->name('afiliaciones.create');
    Route::post('/afiliaciones', [AfiliacionesController::class, 'crearAfiliacion'])->name('afiliaciones.store');
    Route::get('/afiliaciones/{id}/edit', [AfiliacionesController::class, 'edit'])->name('afiliaciones.edit');
    Route::put('/afiliaciones/{id}', [AfiliacionesController::class, 'update'])->name('afiliaciones.update');
    Route::get('/afiliaciones/buscar', [AfiliacionesController::class, 'buscar'])->name('afiliaciones.buscar');
    Route::delete('/afiliaciones/{id}', [AfiliacionesController::class, 'eliminar'])->name('afiliaciones.eliminar');
    Route::get('/afiliaciones/{id}/confirmacion', [AfiliacionesController::class, 'vistaConfirmacion'])->name('afiliaciones.confirmacion');
    Route::get('/afiliaciones/{id}/pdf', [AfiliacionesController::class, 'verPDF'])->name('afiliaciones.pdf');
    Route::get('/afiliaciones/{id}/pdf_seguro', [AfiliacionesController::class, 'verPDFs'])->name('afiliaciones.pdf_seguro');
    Route::get('/afiliaciones/decode-vin', [VehicleController::class, 'showDecodeVinForm'])->name('decode-vin.form');
    Route::get('/afiliaciones/decode-vin/result', [VehicleController::class, 'decodeVin'])->name('decode-vin');
    Route::get('/afiliaciones/decode-vin', [AfiliacionesController::class, 'decodeVin'])->name('afiliaciones.decode-vin');
    Route::post('/check-vin', [VehicleController::class, 'checkVin'])->name('check.vin');
    
    Route::get('/seguros', [SegurosController::class, 'index'])->name('seguros.index');
    Route::get('/seguros/create', [SegurosController::class, 'mostrarFormulario'])->name('seguros.create');
    Route::post('/seguros', [SegurosController::class, 'crearSeguro'])->name('seguros.store');
    Route::get('/seguros/{id}/pago', [SegurosController::class, 'pago'])->name('seguros.pago'); // Asegúrate de que esta esté antes
    Route::get('/seguros/{id}/edit', [SegurosController::class, 'edit'])->name('seguros.edit');
    Route::put('/seguros/{id}', [SegurosController::class, 'update'])->name('seguros.update');
    Route::put('/seguros/{id}/pago', [SegurosController::class, 'updatePago'])->name('seguros.updatePago');
    Route::get('/seguros/buscar', [SegurosController::class, 'buscar'])->name('seguros.buscar');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'checkRole:super-admin'])->group(function () {
    // Aquí van todas las rutas protegidas para el super administrador.
});

Route::group(['middleware' => ['role:admin']], function() {
    
});

Route::group(['middleware' => ['permission:edit articles']], function() {
    
});


require __DIR__.'/auth.php';
