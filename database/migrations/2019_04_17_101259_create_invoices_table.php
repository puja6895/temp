<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function (Blueprint $table) {
			$table->increments('invoice_id');
			$table->string('invoice_no');
			$table->string('invoice_random_no');
			$table->bigInteger('sell_id')->nullable();
			$table->bigInteger('client_id');
			$table->string('client_name');
			$table->string('client_email')->nullable();
			$table->string('client_mobile')->nullable();
			$table->double('amount', 10, 2);
			$table->double('tax', 10, 2);
			$table->double('tax_amount', 10, 2);
			$table->double('adjustment', 10, 2);
			$table->double('shipping_handling', 10, 2);
			$table->tinyInteger('invoice_status')->default(0);
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
		Schema::dropIfExists('invoices');
	}
}
