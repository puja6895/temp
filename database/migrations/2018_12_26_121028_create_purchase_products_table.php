<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('purchase_products', function (Blueprint $table) {
			$table->bigIncrements('purchase_product_id');
			$table->integer('purchase_id');
			$table->integer('product_id');
			$table->decimal('quantity', 8, 2);
			$table->integer('unit_id');
			$table->double('rate', 10, 2);
			$table->double('gst', 10, 2)->default(0);
			$table->double('gst_amount', 10, 2)->default(0);
			$table->double('amount', 10, 2);
			$table->tinyInteger('is_billed')->default(0);
			$table->tinyInteger('purchase_product_status')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('purchase_products');
	}
}
