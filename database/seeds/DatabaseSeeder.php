<?php

use App\Marca;
use App\Producto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// $this->call('UsersTableSeeder');
		factory(Marca::class, 10)->create();
		factory(Producto::class, 10)->create();
	}
}
