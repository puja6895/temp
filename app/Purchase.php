<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {
	//Primary Key
	protected $primaryKey = 'purchase_id';

	// BELONGS TO PURCHASER
	public function purchaser() {
		return $this->belongsTo('App\Purchaser', 'purchaser_id', 'purchaser_id');
	}

	// PURCHASE AMOUNT
	public function purchase_amount() {
		return $this->hasOne('App\PurchaseAmount', 'purchase_id', 'purchase_id');
	}

	// Total Purchase Amount
	public function purchase_amount_sum() {
		return $this->hasOne('App\PurchaseAmount', 'purchase_id', 'purchase_id')->sum('grand_total');
	}

	// Purchase Product
	public function purchase_product() {
		return $this->hasMany('App\PurchaseProduct', 'purchase_id', 'purchase_id');
	}

	/**
	 * Purchase Payments
	 */
	public function purchase_payments() {
		return $this->hasMany('App\PurchaseOrderPayment', 'purchase_id', 'purchase_id');
	}

	// Purchase Payment Sum
	public function purchase_payments_sum() {
		return $this->hasMany('App\PurchaseOrderPayment', 'purchase_id', 'purchase_id')->sum('paid_amount');
	}
}
