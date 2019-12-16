<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('message');
			$table->enum('type', array('Complaint','advice','Inquiry'));
//            $table->integer('contactable_id')->unsigned();
//            $table->string('contactable_type');

        });
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}
