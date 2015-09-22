<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MentorApp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('mentorapp', function(Blueprint $table)
        {
            $table->string('name');
            $table->string('gender');
            $table->string('education');
            $table->string('job');
            $table->string('email');
            $table->string('kickoff');
            $table->string('extra');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('mentorapp');
	}

}
