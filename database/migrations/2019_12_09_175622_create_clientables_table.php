<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientablesTable extends Migration {

	public function up()
	{
		Schema::create('clientables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('client_id')->unsigned();
			$table->integer('clientable_id');
			$table->string('clientable_type');
			$table->boolean('is_read')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clientables');
	}
}