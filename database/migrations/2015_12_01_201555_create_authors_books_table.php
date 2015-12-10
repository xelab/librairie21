<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthorsBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('authors_books', function(Blueprint $table)
		{
			$table->integer('author_id')->unsigned();
			$table->integer('book_id')->unsigned();
			$table->index(['author_id','book_id'], 'index_authors_books_on_author_id_and_book_id');
			$table->index(['book_id','author_id'], 'index_authors_books_on_book_id_and_author_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('authors_books');
	}

}
