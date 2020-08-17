<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model {
	protected $fillable = [
		"nombre","empresa_id"
	];
	public function productos() {
		return $this->hasMany("App\Producto");
	}
}
