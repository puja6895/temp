<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderPayment extends Model {
	//Payment Mode
	public function mode() {
		return $this->belongsTo('App\PaymentMode', 'payament_mode', 'payment_mode_id');
	}
}
