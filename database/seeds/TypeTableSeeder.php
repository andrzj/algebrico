<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class TypeTableSeeder extends Seeder {

    public function run()
    {
        // TestDummy::times(20)->create('App\Post');

        DB::table('types')->insert(array(
        	array('type'=>'Expense'),
        	array('type'=>'Incoming'),
        	array('type'=>'Transfer'),
        ));
    }

}