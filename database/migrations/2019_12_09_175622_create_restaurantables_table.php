<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantablesTable extends Migration {

	public function up()
	{
		Schema::create('resturantables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('resturant_id')->unsigned();
			$table->integer('resturantable_id')->unsigned();
			$table->string('resturantable_type');
			$table->boolean('is_read')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('resturantables');
	}
}