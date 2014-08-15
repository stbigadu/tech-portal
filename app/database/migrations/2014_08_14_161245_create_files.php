<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiles extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4knet_files', function(Blueprint $table)
		{
		    // Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
		    $table->integer('nouvelle_id')->unsigned()->nullable();
		    $table->integer('event_id')->unsigned()->nullable();
		    $table->integer('user_id')->unsigned()->nullable();
		    $table->text('path');
		    $table->text('name');
		    
		    // Foreign keys & indexes
		    $table->foreign('nouvelle_id')->references('id')->on('t4knet_nouvelles');
		    $table->foreign('event_id')->references('id')->on('t4knet_events');
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
		Schema::table('t4knet_files', function(Blueprint $table)
		{
			// Undo changes
			$table->drop();
		});
	}

}
