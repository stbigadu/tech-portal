<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('t4kglo_users', function(Blueprint $table)
		{
		    // Create table
		    $table->create();
		    	
		    // Table schema
		    $table->increments('id');
		    $table->string('email');
		    $table->string('password');
		    $table->string('first_name');
		    $table->string('last_name');
		    $table->text('professional_title')->nullable();
		    $table->string('cellphone_number')->nullable();
		    $table->string('home_number_1')->nullable();
		    $table->string('home_number_2')->nullable();
		    $table->string('other_number')->nullable();
		    $table->string('profile_pic')->nullable();
		    $table->integer('groupe')->nullable();
		    
		    $table->integer('user_role_id')->unsigned();
		    $table->boolean('is_first_connection')->default(1);
		    $table->boolean('is_admin')->default(0);
		    $table->string('remember_token', 100)->nullable();
		    
		    // Indexes & FK
		    $table->foreign('user_role_id')->references('id')->on('t4kglo_user_role');
		    
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
		Schema::table('t4kglo_users', function(Blueprint $table)
		{
		    // Drop table
		    $table->drop();
		});
	}

}
