<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePaymentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoice_payments', function (Blueprint $table) {
			$table->increments('invoice_payment_id');
			$table->integer('invoice_id');
			$table->double('paid_amount', 10, 2);
			$table->integer('payament_mode');
			$table->string('ref')->nullable();
			$table->string('ref_image')->nullable();
			$table->integer('received_by');
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
		Schema::dropIfExists('invoice_payments');
	}
}
