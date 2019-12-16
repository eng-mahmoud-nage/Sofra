<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->text('about_app');
			$table->text('about_us');
			$table->string('phone');
			$table->integer('commission');
			$table->string('bank_name');
			$table->string('bank_account');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
