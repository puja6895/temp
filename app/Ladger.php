<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ladger extends Model {
	protected $fillable = [
		'invoice_payment_id', 'purchase_payment_id', 'credit_amount', 'debit_amount', 'remarks',
	];
}
