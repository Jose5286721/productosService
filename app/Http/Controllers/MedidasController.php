<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Medida;
use App\Traits\ApiResponse;
class MedidasController extends Controller{
    use ApiResponse;
    public function obtenerMedidasByEmpresa($idEmpresa){
        return $this->successResponse(Medida::where("empresa_id",$idEmpresa)->get());
    }
    public function store(Request $request){
        $this->validate($request,[
            "unidad" => "required|string|min:1",
            "empresa_id" => "required|string|min:1"
        ]);
        $medida = Medida::create($request->all());
        return $this->successResponse($medida);
    }
    public function show($id){
        $medida = Medida::findOrFail($id);
        return $this->successResponse($medida);
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            "unidad" => "required|string|min:1"
        ]);
        $medida = Medida::findOrFail($id);
        $medida->fill($request->all());
        if($medida->isClean()){
            return $this->errorResponse("Modifique al menos un valor",422);
        }
        $medida->save();
        return $this->successResponse($medida);
    }
}
