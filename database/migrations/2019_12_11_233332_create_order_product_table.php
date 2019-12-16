<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration {

	public function up()
	{
		Schema::create('order_product', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->float('price');
			$table->integer('quantity');
			$table->string('note')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products_orders');
	}
}
