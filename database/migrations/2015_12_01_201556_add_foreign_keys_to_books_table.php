<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('books', function(Blueprint $table)
		{
			$table->foreign('collection_id', 'books_ibfk_1')->references('id')->on('collections')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('publisher_id', 'books_ibfk_2')->references('id')->on('publishers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('distributor_id', 'books_ibfk_3')->references('id')->on('distributors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('books', function(Blueprint $table)
		{
			$table->dropForeign('books_ibfk_1');
			$table->dropForeign('books_ibfk_2');
			$table->dropForeign('books_ibfk_3');
		});
	}

}
