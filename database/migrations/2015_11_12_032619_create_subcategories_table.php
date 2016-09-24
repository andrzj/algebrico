<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategories', function(Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('subcategory');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('subcategories', function($table){
			$table->foreign('category_id')->references('id')->on('categories');
			$table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subcategories');
	}

}
