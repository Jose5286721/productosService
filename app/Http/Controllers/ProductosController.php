<?php
namespace App\Http\Controllers;
use App\Http\Resources\Json\ProductoCategoriaJson;
use App\Http\Resources\Json\ProductoJson;
use App\Image;
use App\Marca;
use App\Producto;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductosController extends Controller {
	use ApiResponse;

	/**
	 * Metodo para listar todos los productos
	 * @return json Todos los productos
	 */
	/*public function __construct() {
		$marca = Marca::create([
			"nombre" => "Trebol",
		]);
	}*/
	public function index() {
		return $this->successResponse(ProductoCategoriaJson::collection(Producto::all()));
	}
	public function indexCountByEmpresa($idEmpresa) {
		return $this->successResponse(Producto::where("empresa_id", $idEmpresa)->get()->count());
	}
	public function indexByEmpresa($idEmpresa) {
		return ProductoCategoriaJson::collection(Producto::where("empresa_id", $idEmpresa)->paginate());
	}
	public function indexByEmpresaAndSubCategoria($idEmpresa, $idSubCategoria) {
		return $this->successResponse(Producto::where("empresa_id", $idEmpresa)->where("sub_categoria_id", $idSubCategoria)->get());
	}

	/**
	 * Devuelve el producto seleccionado
	 * @param  integer $id El identificador del producto
	 * @return json     El producto en formato json
	 */

	public function show($id) {
		$producto = new ProductoJson(Producto::findOrFail($id));
		return $this->successResponse(new ProductoCategoriaJson($producto));
	}

	public function showByCategoria($idCategoria) {
		$productos = Producto::where('sub_categoria_id', $idCategoria)->get();
		return ProductoCategoriaJson::collection($productos);
	}

	/**
	 * Crea un nuevo producto
	 * @param  Request $request Aqui se obtiene todos los parametros de la peticion
	 * @return json           Devuelve el nuevo producto
	 */

	public function store(Request $request) {
		$this->validate($request, [
			"nombre" => "required|string|max:255",
			"descripcion" => "required|string",
			"precio" => "required|string|min:1",
			"cantidad" => "required",
			"sub_categoria_id" => "required|min:1",
			"empresa_id" => "required|min:1",
			"marca_id" => "required|min:1",
			"imagen" => "required",
			"medida_id" => "required",
			"codigo_barras" => "required",
		]);
		$marca = Marca::findOrFail($request->input("marca_id"));
		$parametros = $request->all();
		$imagen = Image::create([
			"imagen" => $parametros['imagen'],
		]);
		unset($parametros['imagen']);
		$producto = Producto::create($parametros);
		$imagen->producto_id = $producto->id;
		$imagen->save();
		return $this->successResponse($producto);
	}

	/**
	 * Actualiza el producto
	 * @param  Request $request Obtiene todos los parametros que pasa por la peticion
	 * @param  integer  $id      El identificador unico del producto
	 * @return json           El resultado de la actualizacion
	 */

	public function update(Request $request, $id) {

		$this->validate($request, [
			"nombre" => "string|max:255",
			"descripcion" => "string",
			"precio" => "string|min:1",
			"cantidad" => "min:1",
			"marca_id" => "min:1",
			"sub_categoria_id" => "min:1",
			"empresa_id" => "min:1",
			"imagen" => "string",
			"medida_id" => "min:1"
		]);
		$producto = Producto::findOrFail($id);
		$parametros = $request->all();
		$imagenModificar = false;
		if ($request->has("imagen")) {
			$imagen = Image::findOrFail($producto->imagen->id);
			$imagen->imagen = $request->imagen;
			$imagen->save();
			unset($parametros['imagen']);
			$imagenModificar = true;
		}
		$producto->fill($parametros);
		if ($producto->isClean() && $imagenModificar == false) {
			return $this->errorResponse("Modifique al menos un valor", Response::HTTP_UNPROCESSABLE_ENTITY);
		}
		$producto->save();
		return $this->successResponse($producto);
	}

	/**
	 * Elimina el producto
	 * @param  integer $id El identificador del producto
	 * @return json     El resultado de la eliminacion
	 */

	public function destroy($id) {
		$producto = Producto::findOrFail($id);
		$producto->delete();
		Image::findOrFail($producto->image_id);
		$this->successResponse($producto);
	}
}
