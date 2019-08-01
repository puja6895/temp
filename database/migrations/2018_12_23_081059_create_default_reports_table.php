<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultReportsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('default_reports', function (Blueprint $table) {
			$table->increments('default_product_report_id');
			$table->integer('product_id');
			$table->integer('unit_id');
			$table->decimal('sell_price', 10, 2)->default(0);
			$table->tinyInteger('default_status')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('default_reports');
	}
}
