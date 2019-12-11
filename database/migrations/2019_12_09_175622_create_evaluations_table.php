<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluationsTable extends Migration {

	public function up()
	{
		Schema::create('evaluations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('status');
			$table->text('comment')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('evaluations');
	}
}