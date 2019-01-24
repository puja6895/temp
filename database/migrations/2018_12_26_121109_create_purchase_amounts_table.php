<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseAmountsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('purchase_amounts', function (Blueprint $table) {
			$table->increments('purchase_amount_id');
			$table->integer('purchase_id');
			$table->double('subtotal', 10, 2);
			$table->double('gst', 10, 2)->default(0);
			$table->double('adjustment', 10, 2)->default(0);
			$table->double('others', 10, 2)->default(0);
			$table->double('grand_total', 10, 2);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('purchase_amounts');
	}
}
