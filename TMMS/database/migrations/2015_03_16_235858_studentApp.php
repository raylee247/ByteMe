<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StudentApp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('studentapp', function(Blueprint $table)
        {
            $table->string('name');
            $table->string('gender');
            $table->string('csid');
            $table->integer('standing');
            $table->string('courses');
            $table->string('email');
            $table->string('program');
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
        Schema::drop('studentapp');
	}

}
