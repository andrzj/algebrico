<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }
    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
