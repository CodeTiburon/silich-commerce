<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('main_users', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email');
            $table->string('password', 60);
            $table->enum('role',['admin', 'user', 'guest'])->default('user');
            $table->rememberToken();
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
		Schema::drop('main_users');
	}

}
