<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistributorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('distributors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->timestamps();
			$table->text('address', 65535)->nullable();
			$table->string('city')->nullable();
			$table->string('zip')->nullable();
			$table->string('phone')->nullable();
			$table->string('mail')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('distributors');
	}

}
