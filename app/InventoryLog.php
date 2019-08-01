<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model {
	protected $primaryKey = 'inventory_log_id';

	// Product
	public function product() {
		return $this->belongsTo('App\Product', 'product_id', 'product_id');
	}

	// Unit
	public function unit() {
		return $this->belongsTo('App\Unit', 'unit_id', 'unit_id');
	}

	// Created By
	public function user() {
		return $this->belongsTo('App\User', 'created_by', 'id');
	}
}
