<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration {

	public function up()
	{
		Schema::create('reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->enum('status', array(1,2,3,4,5));
			$table->integer('restaurant_id')->unsigned();
			$table->text('comment')->nullable();
			$table->integer('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('reviews');
	}
}
