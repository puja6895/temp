<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $primaryKey = 'product_id';

    // Belongs TO Category
    public function category()
    {
    	return $this->belongsTo('App\Category','category_id','category_id');
    }
}
