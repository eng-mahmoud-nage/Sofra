<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title');
			$table->text('content');
			$table->integer('order_id')->unsigned();
			$table->integer('notifable_id')->unsigned();
			$table->string('notifable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}
