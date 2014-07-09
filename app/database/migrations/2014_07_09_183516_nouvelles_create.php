<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NouvellesCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4knet_nouvelles', function(Blueprint $table)
		{
			// Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
		    $table->dateTime('datetime');
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
		Schema::table('t4knet_nouvelles', function(Blueprint $table)
		{
			// Table drop
		    $table->drop();
		});
	}

}
