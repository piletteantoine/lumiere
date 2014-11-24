<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cards', function($table) {
			$table->increments('id');
			$table->string('title');
			$table->text('description')->nullable();
			$table->text('poster_url')->nullable();
			$table->text('thumb_url')->nullable();
			$table->integer('date_publication');
			$table->integer('date_production');
			$table->integer('length');
			$table->integer('location');
			$table->float('location_lat');
			$table->float('location_long');
			$table->text('video_url');
			$table->text('categories_id');
			$table->boolean('is_trailer');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cards');
	}

}
