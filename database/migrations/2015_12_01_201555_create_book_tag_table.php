<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('book_tag', function(Blueprint $table)
		{
			$table->integer('book_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->index(['book_id','tag_id'], 'index_book_tag_on_book_id_and_tag_id');
			$table->index(['tag_id','book_id'], 'index_book_tag_on_tag_id_and_book_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('book_tag');
	}

}
