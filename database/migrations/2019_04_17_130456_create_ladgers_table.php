<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadgersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('ladgers', function (Blueprint $table) {
			$table->increments('ladger_id');
			$table->integer('invoice_payment_id')->nullable();
			$table->integer('purchase_payment_id')->nullable();
			$table->double('credit_amount', 10, 2)->default(0);
			$table->double('debit_amount', 10, 2)->default(0);
			$table->text('remarks')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('ladgers');
	}
}
