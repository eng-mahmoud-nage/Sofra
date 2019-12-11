<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('payment_method_id')->unsigned();
			$table->text('notes')->nullable();
			$table->string('address');
			$table->float('total_price');
			$table->float('net');
			$table->float('total_commission');
			$table->string('status');
			$table->string('delivery_charge');
			$table->time('processing_time');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}