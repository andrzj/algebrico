<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
    	Schema::create('transactions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->decimal('amount', 20, 2)->default(0.00);
            $table->bigInteger('account_id')->unsigned();
            $table->bigInteger('accountto_id')->unsigned()->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->nullable();
            $table->bigInteger('type_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned()->nullable();
            $table->datetime('date');
            $table->bigInteger('due_month');
            $table->bigInteger('due_year');
            $table->text('note');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('transactions', function($table){
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('accountto_id')->references('id')->on('accounts');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('vendor_id')->references('id')->on('vendors');
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
      	Schema::drop('transactions');
      }
}