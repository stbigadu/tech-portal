<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventPresenceCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4knet_event_presence', function(Blueprint $table)
		{
			// Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
		    $table->dateTime('datetime_start');
		    $table->dateTime('datetime_end');
		    $table->boolean('is_attending')->nullable();
		    $table->integer('user_id')->unsigned()->nullable();
		    $table->integer('event_id')->unsigned()->nullable();
		    
		    // Indexes & FK
		    $table->foreign('user_id')->references('id')->on('t4kglo_users');
		    $table->foreign('event_id')->references('id')->on('t4knet_events');
		     
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
		Schema::table('t4knet_event_presence', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
