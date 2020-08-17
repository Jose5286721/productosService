<?php
namespace App\Http\Controllers;
use App\Marca;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MarcaController extends Controller {
	use ApiResponse;
	public function index() {
		return $this->successResponse(Marca::all());
	}
	public function showByEmpresaId($idEmpresa){
		return $this->successResponse(Marca::where("empresa_id",$idEmpresa)->get());
	}
	public function show($id) {
		$marca = Marca::findOrFail($id);
		return $this->successResponse($marca);
	}
	public function store(Request $request) {
		$this->validate($request, [
			"nombre" => "required|string|max:255",
			"empresa_id" => "required|string|min:1",
		]);
		$marca = Marca::create($request->all());
		return $this->successResponse($marca);
	}
	public function update(Request $request, $id) {
		$this->validate($request, [
			"nombre" => "required|string|max:255",
		]);
		$marca = Marca::findOrFail($id);
		$marca->fill($request->all());
		if ($marca->isClean()) {
			return $this->errorResponse("Modifica el nombre de la marca", Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		$marca->save();
		return $this->successResponse($marca);
	}
	public function destroy($id) {
		$marca = Marca::findOrFail($id);
		$cantidadProductos = $marca->productos()->get()->count();
		if ($cantidadProductos > 0) {
			return $this->errorResponse("No puede eliminar esta marca porque tiene productos asociados", Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		$marca->delete();
		return $this->successResponse($marca);
	}
}
