<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			// Create table
			$table->create();
			
			// Table schema
			$table->increments('id');
			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('first_name');
			$table->string('last_name');
			$table->text('professional_title')->nullable();
			$table->string('cellphone_number')->nullable();
			$table->string('home_number_1')->nullable();
			$table->string('home_number_2')->nullable();
			$table->string('office_number')->nullable();
			$table->integer('user_cat_id')->unsigned();
			$table->string('profile_pic')->nullable();
			$table->integer('groupe')->nullable();
			$table->boolean('is_first_connection')->default(1);
			$table->boolean('is_admin')->default(0);
			$table->string('remember_token', 100)->nullable();
				
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
		Schema::table('users', function(Blueprint $table)
		{
			// Drop table
			$table->drop();
		});
	}

}
