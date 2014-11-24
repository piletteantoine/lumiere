<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table) {
			$table->increments('id');
			$table->string('title', 100);
			$table->longText('content');
			
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users');

			$table->text('excerpt');
			$table->timestamp('published_on');
			
			$table->timestamps();
			$table->softDeletes();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}
