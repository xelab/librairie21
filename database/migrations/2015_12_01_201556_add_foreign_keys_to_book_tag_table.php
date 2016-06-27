<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBookTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('book_tag', function(Blueprint $table)
		{
			$table->foreign('book_id', 'book_tag_ibfk_1')->references('id')->on('books')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('tag_id', 'book_tag_ibfk_2')->references('id')->on('tags')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('book_tag', function(Blueprint $table)
		{
			$table->dropForeign('book_tag_ibfk_1');
			$table->dropForeign('book_tag_ibfk_2');
		});
	}

}
