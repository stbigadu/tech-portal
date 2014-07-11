<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventsCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4knet_events', function(Blueprint $table)
		{
			// Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
		    $table->dateTime('datetime_start');
		    $table->dateTime('datetime_end');
		    $table->integer('user_id')->unsigned()->nullable();
		    $table->text('title');
		    $table->text('content');
		    
		    // Indexes & FK
		    $table->foreign('user_id')->references('id')->on('t4kglo_users');
		     
		    // Table administration
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
		Schema::table('t4knet_events', function(Blueprint $table)
		{
			// Undo change
			$table->drop();
		});
	}

}
