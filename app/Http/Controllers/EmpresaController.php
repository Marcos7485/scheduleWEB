<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearEmpresaRequest;
use App\Http\Requests\UpdateImageEmpresa;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    public function empresa()
    {

        $user = Auth::user();

        $empresa = Empresa::where('idUser', $user->id)->first();

        $data = ['empresa' => $empresa];

        return view('empresa.menu', $data);
    }

    public function crearEmpresa(CrearEmpresaRequest $request)
    {

        $user = Auth::user();
        $imagePath = $request->file('image')->store('empresas.images', 'public');

        Empresa::create([
            'idUser' => $user->id,
            'nombre' => $request->nombre,
            'image' => $imagePath,
            'telefono' => $request->telefono
        ]);

        $empresa = Empresa::where('idUser', $user->id)->first();

        $data = ['empresa' => $empresa];

        return redirect()->route('empresa', $data)->with('success', 'Empresa creada con suceso');
    }

    public function destroy()
    {
        $user = Auth::user();
        $empresa = Empresa::where('idUser', $user->id)->firstOrFail();
        $empresa->delete();
        if ($empresa->image) {
            Storage::disk('public/empresas/images')->delete($empresa->image);
        }
        $empresa = Empresa::where('idUser', $user->id)->first();
        $data = ['empresa' => $empresa];
        return redirect()->route('empresa', $data)->with('info', 'Empresa eliminada correctamente');
    }

    public function updateImage(UpdateImageEmpresa $request){

        $empresa = Empresa::findOrFail($request->empresa_id);

        // Eliminar la imagen antigua si existe
        if ($empresa->image) {
            Storage::disk('public')->delete($empresa->image);
        }

        // Subir la nueva imagen
        $imagePath = $request->file('image')->store('images', 'public');
        $empresa->image = $imagePath;
        $empresa->save();

        return redirect()->route('empresa')->with('info', 'Imagen actualizada correctamente');
    }
}
