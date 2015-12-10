<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCollectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('collections', function(Blueprint $table)
		{
			$table->foreign('publisher_id', 'collections_ibfk_1')->references('id')->on('publishers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('collections', function(Blueprint $table)
		{
			$table->dropForeign('collections_ibfk_1');
		});
	}

}
