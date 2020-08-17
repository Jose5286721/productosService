<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoCategoriaJson extends JsonResource {
	public function toArray($request) {
		return [
			'id' => $this->id,
			'codigo' => $this->codigo_barras,
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
			'precio' => $this->precio,
			'imagen' => $this->imagen->imagen,
			'marca_id' => $this->marca->nombre,
			'cantidad' => $this->cantidad,
			'sub_categoria_id' => $this->sub_categoria_id,
			'medida' => $this->medida->unidad,
		];
	}
}
