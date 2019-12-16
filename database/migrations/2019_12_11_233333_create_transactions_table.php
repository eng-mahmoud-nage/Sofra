<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('restaurant_id')->unsigned();
			$table->double('paid');
			$table->double('residual')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}