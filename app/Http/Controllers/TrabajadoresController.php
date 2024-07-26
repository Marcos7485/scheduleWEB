<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearTrabajador;
use App\Http\Requests\UpdateImageProf;
use App\Models\Empresa;
use App\Models\Trabajadores;
use App\Services\TrabSrv;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrabajadoresController extends Controller
{
    protected $TrabSrv;

    public function __construct(TrabSrv $TrabSrv)
    {
        $this->TrabSrv = $TrabSrv;
    }

    public function menu()
    {
        $user = Auth::user();
        $empresa = Empresa::where('idUser', $user->id)->first();
        $trabajadores = Trabajadores::where('idEmpresa', $empresa->id)->get();

        $data = ['trabajadores' => $trabajadores];

        return view('trabajadores.menu', $data);
    }

    public function crearTrabajador(CrearTrabajador $request)
    {
        $user = Auth::user();
        $empresa = Empresa::where('idUser', $user->id)->first();
        $trabajador = new Trabajadores();
        $trabajador->idEmpresa = $empresa->id;
        $trabajador->nombre = $request->nombre;
        $trabajador->telefono = $request->telefono;

        if ($request->image) {
            $imagePath = $request->file('image')->store('trabajadores.profiles', 'public');
            $trabajador->image = $imagePath;
        }

        if ($request->background) {
            $backgroundPath = $request->file('background')->store('trabajadores.backgrounds', 'public');
            $trabajador->background = $backgroundPath;
        }

        if ($request->frase) {
            $trabajador->frase = $request->frase;
        }

        $trabajador->selected = 0;
        $trabajador->active = '1';
        $trabajador->save();


        $trabajadores = Trabajadores::where('idEmpresa', $empresa->id)->get();

        $data = ['trabajadores' => $trabajadores];

        return redirect()->route('trabajadores', $data)->with('success', 'Trabajador creado con suceso');
    }

    public function details($id)
    {
        $info = $this->TrabSrv->TransformTrabajador($id);
        return view('trabajadores.details', $info);
    }

    public function updateImage(UpdateImageProf $request)
    {

        $trabajador = Trabajadores::findOrFail($request->trabajador_id);

        // Eliminar la imagen antigua si existe
        if ($trabajador->image) {
            Storage::disk('public')->delete($trabajador->image);
        }

        // Subir la nueva imagen
        $imagePath = $request->file('image')->store('trabajadores.profiles', 'public');
        $trabajador->image = $imagePath;
        $trabajador->save();

        return redirect()->route('trabajador.details', ['id' => $trabajador->id])->with('info', 'Imagen actualizada correctamente');
    }

    public function updateBackground(UpdateImageProf $request)
    {

        $trabajador = Trabajadores::findOrFail($request->trabajador_id);

        // Eliminar la imagen antigua si existe
        if ($trabajador->background) {
            Storage::disk('public')->delete($trabajador->background);
        }

        // Subir la nueva imagen
        $imagePath = $request->file('image')->store('trabajadores.backgrounds', 'public');
        $trabajador->background = $imagePath;
        $trabajador->save();

        return redirect()->route('trabajador.details', ['id' => $trabajador->id])->with('info', 'Background actualizado correctamente');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $empresa = Empresa::where('idUser', $user->id)->firstOrFail();
        $trabajador = Trabajadores::where('id', $id)->firstOrFail();
        if ($trabajador->idEmpresa == $empresa->id) {
            $trabajador->delete();
            $trabajador->active = 0;
            $trabajador->save();
            if ($trabajador->image) {
                Storage::disk('public')->delete($trabajador->image);
            }

            if ($trabajador->background) {
                Storage::disk('public')->delete($trabajador->background);
            }

            return redirect()->route('trabajadores')->with('info', 'Trabajador eliminado correctamente');
        }
    }
}
