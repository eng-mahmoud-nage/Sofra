<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->float('coast')->default(0);
			$table->float('net')->default(0);
			$table->float('commission')->default(0);
			$table->float('delivery_charge')->default(0);
			$table->enum('status',
                array('pending', 'accepted', 'rejected', 'delivered', 'canceled'))
                ->default('pending');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->double('total')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
