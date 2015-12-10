<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBooksTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('books_tags', function(Blueprint $table)
		{
			$table->foreign('book_id', 'books_tags_ibfk_1')->references('id')->on('books')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tag_id', 'books_tags_ibfk_2')->references('id')->on('tags')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('books_tags', function(Blueprint $table)
		{
			$table->dropForeign('books_tags_ibfk_1');
			$table->dropForeign('books_tags_ibfk_2');
		});
	}

}
