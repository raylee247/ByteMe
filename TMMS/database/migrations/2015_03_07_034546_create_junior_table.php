<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuniorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('junior', function(Blueprint $table)
		{
            $table->increments('jid');
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
		Schema::drop('junior');
	}

}
