<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImporterHelper extends Model
{
    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }
    public function subcategory(){
    	return $this->belongsTo('App\Models\Subcategory');
    }
    public function vendor(){
    	return $this->belongsTo('App\Models\Vendor');
    }
}
