<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model {

	protected $fillable = [
		"nombre","codigo_barras", "descripcion", "precio", "cantidad", "medida_id","sub_categoria_id", "marca_id", "image_id", "empresa_id",
	];

	public function imagen() {
		return $this->hasOne("App\Image");
	}
	public function marca() {
		return $this->belongsTo("App\Marca");
	}
	public function medida(){
		return $this->belongsTo("App\Medida");	
	}
}
