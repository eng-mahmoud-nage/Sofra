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
			$table->integer('order_id')->unsigned();
			$table->string('content');
			$table->double('total_sales');
			$table->double('paid');
			$table->double('residual');
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}