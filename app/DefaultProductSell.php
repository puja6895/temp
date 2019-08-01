<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultProductSell extends Model {
	//
	protected $primaryKey = 'default_product_sell_id';

	// Product
	public function product() {
		return $this->belongsTo('App\Product', 'product_id', 'product_id');
	}

	// Unit
	public function unit() {
		return $this->belongsTo('App\Unit', 'unit_id', 'unit_id');
	}
}
