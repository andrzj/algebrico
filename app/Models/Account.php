<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    /*
    * Updates the balance from a given account
    * @param: $id => Account id
    * @param: $value => Value of a new transacation to be calculated
    */
    public static function updateBalance($id, $value){
    	$account = Account::findOrFail($id);

		$account->balance += $value;
		$account->save();
    }
}