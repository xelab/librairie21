<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAuthorBookTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('author_book', function(Blueprint $table)
		{
			$table->foreign('author_id', 'author_book_ibfk_1')->references('id')->on('authors')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('book_id', 'author_book_ibfk_2')->references('id')->on('books')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('author_book', function(Blueprint $table)
		{
			$table->dropForeign('author_book_ibfk_1');
			$table->dropForeign('author_book_ibfk_2');
		});
	}

}
