<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
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
}
