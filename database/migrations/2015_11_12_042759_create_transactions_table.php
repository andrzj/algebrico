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

        $sql = "
            CREATE PROCEDURE `spSetAccountAmount`(IN curr_account INT)
            BEGIN
              DECLARE curr_balance DECIMAL(20,2);
                
              SELECT 
                SUM(CASE WHEN type_id = 3 AND account_id = curr_account THEN amount * -1 ELSE amount END) AS TOTAL
                INTO curr_balance
              FROM transactions
                WHERE account_id = curr_account
              OR accountto_id = curr_account
              ORDER BY date;
                
                UPDATE accounts 
                SET balance = curr_balance
                WHERE id = curr_account;
            END
        ";

        DB::unprepared($sql);

        $sql = "
            CREATE PROCEDURE `spTotalCategory`(IN due_month INT, IN due_year INT, IN type_id INT)
            BEGIN
                SELECT 
                    `c`.`id`,
                    `c`.`category` AS `category`,
                    SUM(`t`.`amount`) AS `total_amount`
                FROM
                    (`transactions` `t`
                    LEFT JOIN `categories` `c` ON ((`t`.`category_id` = `c`.`id`)))
                WHERE `t`.`due_month` = due_month
                AND `t`.`due_year` = due_year             
                AND `t`.`type_id` = type_id
                GROUP BY `t`.`category_id`
                ORDER BY `total_amount`;
            END
        ";

        DB::unprepared($sql);

        $sql = "
            CREATE PROCEDURE `spTotalSubCategory`(IN category_id INT, IN due_month INT, IN due_year INT, IN type_id INT)
            BEGIN
                SELECT 
                    `s`.`id`,
                    `s`.`subcategory` AS `subcategory`,
                    SUM(`t`.`amount`) AS `total_amount`
                FROM
                    (`transactions` `t`
                    LEFT JOIN `subcategories` `s` ON ((`t`.`subcategory_id` = `s`.`id`)))
                WHERE `t`.`due_month` = due_month
                AND `t`.`due_year` = due_year             
                AND `t`.`type_id` = type_id
                AND `t`.`category_id` = category_id
                GROUP BY `t`.`subcategory_id`
                ORDER BY `total_amount`;
            END
        ";

        DB::unprepared($sql);
    }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
      	Schema::drop('transactions');
        DB::unprepared("DROP procedure IF EXISTS spSetAccountAmount");
        DB::unprepared("DROP procedure IF EXISTS spTotalCategory");
        DB::unprepared("DROP procedure IF EXISTS spTotalSubCategory");
      }
}