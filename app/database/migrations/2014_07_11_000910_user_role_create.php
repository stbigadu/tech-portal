<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRoleCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kglo_user_role', function(Blueprint $table)
		{
		    // Create table
		    $table->create();
		     
		    // Table schema
		    $table->increments('id');
		    $table->string('title');
		    
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
		Schema::table('t4kglo_user_role', function(Blueprint $table)
		{
			// Drop table
		    $table->drop();
		});
	}

}
