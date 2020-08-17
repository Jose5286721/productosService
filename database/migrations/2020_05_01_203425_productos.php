<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('productos', function (Blueprint $table) {
			$table->id();
			$table->string("codigo_barras");
			$table->string("nombre");
			$table->text("descripcion");
			$table->double("precio", 20, 2);
			$table->double("cantidad", 8, 2);
			$table->unsignedBigInteger("marca_id");
			$table->unsignedBigInteger("sub_categoria_id");
			$table->unsignedBigInteger("empresa_id");
			$table->unsignedBigInteger("medida_id");
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('productos');
	}
}
