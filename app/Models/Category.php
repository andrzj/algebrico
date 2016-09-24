<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories()
    {
        return $this->hasMany('App\Models\Subcategory');
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
