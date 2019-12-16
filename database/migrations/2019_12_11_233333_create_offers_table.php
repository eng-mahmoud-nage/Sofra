<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('image');
			$table->string('name');
			$table->string('description');
			$table->date('from');
			$table->integer('restaurant_id')->unsigned();
			$table->date('to');
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}