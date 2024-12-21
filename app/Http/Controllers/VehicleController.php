<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VehicleController extends Controller
{
    public function showDecodeVinForm()
    {
        return view('afiliaciones.decode-vin');
    }

    public function decodeVin(Request $request)
    {
        $vin = $request->input('vin');

        if (strlen($vin) !== 17) {
            return redirect()->back()->with('error', 'El VIN debe tener 17 caracteres.');
        }

        $response = Http::get("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/{$vin}", [
            'format' => 'json'
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('response', $response->json());
        } else {
            return redirect()->back()->with('error', 'No se pudo obtener la información del VIN.');
        }
    }
}
