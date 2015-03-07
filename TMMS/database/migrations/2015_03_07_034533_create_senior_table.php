<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeniorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('senior', function(Blueprint $table)
		{
            $table->increments('sid');
            $table->integer('studentNum');
            $table->integer('yearStand');
            $table->string('programOfStudy');
            $table->string('courses');
            $table->string('info');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('senior');
	}

}
