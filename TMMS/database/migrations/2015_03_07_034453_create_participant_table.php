<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('participant', function(Blueprint $table)
		{
			$table->increments('pid');
			$table->string('name');
            $table->string('gender');
            $table->string('kickoff');
            $table->string('email');
            $table->boolean('waitlist');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('participant');
	}

}
