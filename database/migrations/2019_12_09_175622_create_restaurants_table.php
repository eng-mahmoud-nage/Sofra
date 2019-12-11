<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone')->unique();
			$table->integer('district_id')->unsigned();
			$table->string('pin_code')->nullable();
			$table->string('api_token')->nullable();
			$table->string('password');
			$table->integer('category_id')->unsigned();
			$table->string('image')->default('general.png');
			$table->float('minimum_charge');
			$table->float('delivery_charge');
			$table->string('whats_app_number');
			$table->tinyInteger('status')->nullable();
			$table->boolean('active')->default(1);
			$table->float('commission')->default('10');
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}