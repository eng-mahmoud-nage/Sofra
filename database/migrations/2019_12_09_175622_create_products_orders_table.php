<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsOrdersTable extends Migration {

	public function up()
	{
		Schema::create('products_orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->float('price');
			$table->integer('quantity');
			$table->float('total');
			$table->string('product_note')->nullable();
			$table->time('processing_time');
		});
	}

	public function down()
	{
		Schema::drop('products_orders');
	}
}