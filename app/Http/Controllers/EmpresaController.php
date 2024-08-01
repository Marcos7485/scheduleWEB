<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrearEmpresaRequest;
use App\Http\Requests\UpdateImageEmpresa;
use App\Models\Empresa;
use App\Models\EmpresaDispo;
use App\Models\GlobalHash;
use App\Models\Trabajadores;
use App\Services\TurnosSrv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    protected $TurnosSrv;

    public function __construct(TurnosSrv $TurnosSrv)
    {
        $this->TurnosSrv = $TurnosSrv;
    }

    public function empresa()
    {

        $user = Auth::user();

        $empresa = Empresa::where('idUser', $user->id)->where('active', 1)->first();

        $data = ['empresa' => $empresa];

        return view('empresa.menu', $data);
    }

    public function crearEmpresa(CrearEmpresaRequest $request)
    {

        $user = Auth::user();
        $globalHash = new GlobalHash();
        $imagePath = $request->file('image')->store('empresas.images', 'public');

        Empresa::create([
            'idUser' => $user->id,
            'nombre' => $request->nombre,
            'image' => $imagePath,
            'telefono' => $request->telefono
        ]);

        $empresa = Empresa::where('idUser', $user->id)->where('active', 1)->first();

        $globalHash->idEmpresa = $empresa->id;
        $globalHash->hash = $this->TurnosSrv->TurnosHashGen();
        $globalHash->lapso = '30';
        $globalHash->active = "1";

        $globalHash->save();

        $data = ['empresa' => $empresa];

        return redirect()->route('empresa', $data)->with('success', 'Empresa creada con suceso');
    }

    public function destroy()
    {
        $user = Auth::user();
        $empresa = Empresa::where('idUser', $user->id)->firstOrFail();
        EmpresaDispo::where('idEmpresa', $empresa->id)->delete();
        GlobalHash::where('idEmpresa', $empresa->id)->delete();

        $trabajadores = Trabajadores::where('idEmpresa', $empresa->id)->get();

        foreach ($trabajadores as $trabajador) {
            if ($trabajador->idEmpresa == $empresa->id) {
                $trabajador->delete();
                if ($trabajador->image) {
                    Storage::disk('public')->delete($trabajador->image);
                }

                if ($trabajador->background) {
                    Storage::disk('public')->delete($trabajador->background);
                }
            }
        }

        $empresa->active = 0;
        $empresa->save();
        $empresa->delete();
        if ($empresa->image) {
            Storage::disk('public')->delete($empresa->image);
        }
        $empresa = Empresa::where('idUser', $user->id)->first();
        $data = ['empresa' => $empresa];
        return redirect()->route('empresa', $data)->with('info', 'Empresa eliminada correctamente');
    }

    public function updateImage(UpdateImageEmpresa $request)
    {

        $empresa = Empresa::findOrFail($request->empresa_id);

        // Eliminar la imagen antigua si existe
        if ($empresa->image) {
            Storage::disk('public')->delete($empresa->image);
        }

        // Subir la nueva imagen
        $imagePath = $request->file('image')->store('empresas.images', 'public');
        $empresa->image = $imagePath;
        $empresa->save();

        return redirect()->route('empresa')->with('info', 'Imagen actualizada correctamente');
    }

    public function registrarTurnoEmpresa($token, $id){
        $GlobalHash = GlobalHash::where('hash', $token)->where('active', 1)->first();

        $empresa = Empresa::where('id', $GlobalHash->idEmpresa)->where('active', 1)->first();
        $trabajador = Trabajadores::where('id', $id)->where('idEmpresa', $empresa->id)->where('active', 1)->first();
        

        $data = [
            'empresa' => $empresa,
            'trabajador' => $trabajador,
            'token' => $token,
            'lapsos' => $GlobalHash->lapso,
            'message' => '',
        ];

        return view('trabajadores.crearTurno', $data);
    }
}
