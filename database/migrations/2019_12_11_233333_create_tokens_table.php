<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('token');
			$table->enum('type', array('android', 'IOS'));
			$table->integer('accountable_id')->unsigned();
			$table->string('accountable_type');
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}
