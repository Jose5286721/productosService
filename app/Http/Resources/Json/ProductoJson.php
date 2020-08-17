<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoJson extends JsonResource {
	public function toArray($request) {
		return [
			'id' => $this->id,
			'nombre' => $this->nombre,
			'descripcion' => $this->descripcion,
			'precio' => $this->precio,
			'imagen' => $this->imagen->imagen,
			'marca_id' => $this->marca->nombre,
			'sub_categoria_id' => $this->sub_categoria_id
		];
	}
}
