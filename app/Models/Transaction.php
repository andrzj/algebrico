<?php

namespace App\Models;

use App\Http\Requests;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;
use App\Models\Account;
use Auth;

class Transaction extends Model
{
    public function account(){
    	return $this->belongsTo('App\Models\Account');
    }
    public function accountto(){
    	return $this->belongsTo('App\Models\Account');
    }
    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }
    public function subcategory(){
    	return $this->belongsTo('App\Models\Subcategory');
    }
    public function type(){
    	return $this->belongsTo('App\Models\Type');
    }
    public function vendor(){
    	return $this->belongsTo('App\Models\Vendor');
    }


    public static function keep($request, $transaction, $arr = null){
        $type_id = $request->input("type_id");
        $amount = ($arr == null) ? str_replace(',', '.', str_replace('.', '', $request->input("amount"))) : $arr['amount'];
        $old_amount = $transaction->amount;
        $transaction->amount = ($type_id == 1) ? $amount * -1 : $amount;
        $old_account_id = $transaction->account_id;
        $transaction->account_id = $request->input("account_id");
        $old_accountto_id = $transaction->accountto_id;
        $transaction->accountto_id = ($type_id == 3) ? $request->input("accountto_id") : null;
        $transaction->category_id = ($type_id == 3) ? null : $request->input("category_id");
        $transaction->subcategory_id = ($type_id == 3) ? null : $request->input("subcategory_id");
        $transaction->type_id = $type_id;

        if($type_id == 3 || empty($request->input("vendor_id")) || $request->input("vendor_id") == 'undefined'){
            $transaction->vendor_id = null;
        } else {
            // Verify if what was used in 'vendor' field is a new or a existent register
            $vendor_id_or_name = $request->input("vendor_id");
            $verify_vendor = $request->input("vendor_id_new_value");
            if($verify_vendor == 'true'){
                $vendor = new Vendor();
                $vendor->vendor = $vendor_id_or_name;
                $vendor->user_id = Auth::user()->id;
                $vendor->save();
                $vendor_id_or_name = $vendor->id;
            }
            $vendor = Vendor::findOrFail($vendor_id_or_name);
            $vendor->category_id = $transaction->category_id;
            $vendor->subcategory_id = $transaction->subcategory_id;
            $vendor->save();

            $transaction->vendor_id = $vendor_id_or_name;
        }       

        $dt = explode("/", $request->input("date"));
        $transaction->date = $dt[2].'-'.$dt[1].'-'.$dt[0];
        $transaction->due_month = ($arr == null) ? (($transaction->account_id != 2 && $transaction->account_id != 3) ? $dt[1] : $request->input("due_month")) : $arr['due_month'];
        $transaction->due_year = ($arr == null) ? (($transaction->account_id != 2 && $transaction->account_id != 3) ? $dt[2] : $request->input("due_year")) : $arr['due_year'];
        $transaction->note = $request->input("note");
        $transaction->user_id = Auth::user()->id;

        if($transaction->id){
            //echo "alteraçao";
            if($type_id == 3){
                //Undo
                Account::updateBalance($old_account_id, $old_amount);
                Account::updateBalance($old_accountto_id, $old_amount * -1);

                //Redo
                Account::updateBalance($transaction->account_id, $transaction->amount * -1);
                Account::updateBalance($transaction->accountto_id, $transaction->amount);
            } else {
                //Undo
                Account::updateBalance($old_account_id, $old_amount * -1);

                //Redo
                Account::updateBalance($transaction->account_id, $transaction->amount);
            }
        } else {
            if($type_id == 3){
                //echo "inclusao - transferencia";
                Account::updateBalance($transaction->account_id, $transaction->amount * -1);
                Account::updateBalance($transaction->accountto_id, $transaction->amount);
            } else {
                //echo "inclusao - E/S";
                Account::updateBalance($transaction->account_id, $transaction->amount);
            }
        }

        $transaction->save();
    }}
