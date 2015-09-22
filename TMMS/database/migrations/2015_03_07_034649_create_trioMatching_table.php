<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrioMatchingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trioMatching', function(Blueprint $table)
		{
			$table->increments('tid');
			$table->integer('wid');
            $table->string('mentor');
            $table->string('senior');
            $table->string('junior');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trioMatching');
	}

}
