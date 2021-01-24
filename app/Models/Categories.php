<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'cat_name','cat_type','user_id'
    ];

    public function category_type(){
        return $this->belongsTo('App\Models\CategoryType','cat_type','id');
    }

    public function trans(){
        return $this->hasMany(Transactions::class);
    }

    
}
