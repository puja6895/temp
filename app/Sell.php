<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model {
	protected $primaryKey = 'sell_id';

	// BELONGS TO Customer
	public function customer() {
		return $this->belongsTo('App\Customer', 'customer_id', 'customer_id');
	}

	// Sell AMOUNT
	public function sell_amount() {
		return $this->hasOne('App\SellAmount', 'sell_id', 'sell_id');
	}

	// Sell Product
	public function sell_product() {
		return $this->hasMany('App\SellProduct', 'sell_id', 'sell_id');
	}
}
