<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $fillable = [
        'category_id','amount','note','user_id'
    ];

    public function cate(){
        return $this->belongsTo('App\Models\Categories','category_id','id');
    }
}
