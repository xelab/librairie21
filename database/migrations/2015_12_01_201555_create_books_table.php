<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('isbn', 64, 0)->nullable();
			$table->integer('collection_id')->unsigned()->nullable()->index('index_books_on_collection_id');
			$table->integer('publisher_id')->unsigned()->nullable()->index('index_books_on_publisher_id');
			$table->decimal('price')->nullable();
			$table->date('released')->nullable();
			$table->string('title');
			$table->text('summary', 65535)->nullable();
			$table->timestamps();
			$table->integer('deposit')->nullable();
			$table->integer('buy')->nullable();
			$table->integer('distributor_id')->unsigned()->nullable()->index('index_books_on_distributor_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('books');
	}

}
