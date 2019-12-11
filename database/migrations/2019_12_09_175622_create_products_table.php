<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->text('notes')->nullable();
			$table->float('price', 8,2);
			$table->float('discount')->nullable();
			$table->time('processing_time');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}