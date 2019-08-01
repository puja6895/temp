<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderPaymentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_order_payments', function (Blueprint $table) {
			$table->increments('purchase_order_payment_id');
			$table->integer('purchase_id');
			$table->double('paid_amount', 10, 2);
			$table->integer('payament_mode');
			$table->string('ref')->nullable();
			$table->string('ref_image')->nullable();
			$table->integer('paid_by');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('purchase_order_payments');
	}
}
