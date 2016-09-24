<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
