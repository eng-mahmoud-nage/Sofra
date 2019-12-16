<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('email')->unique();
			$table->string('phone')->unique();
			$table->integer('district_id')->unsigned();
			$table->string('pin_code')->nullable();
			$table->string('api_token')->unique()->nullable();
			$table->string('password');
			$table->string('image')->default('general.png');
			$table->float('minimum_charge');
			$table->float('delivery_charge');
			$table->string('whats_app_number');
			$table->integer('delivery_time');
            $table->boolean('active')->default(1);
            $table->enum('available', array('open', 'close'));
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
