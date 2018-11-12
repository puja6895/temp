<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchasers', function (Blueprint $table) {
            $table->increments('purchaser_id');
            $table->string('purchaser_name');
            $table->string('company')->nullable();
            $table->string('purchaser_mobile');
            $table->string('purchaser_email')->nullable();
            $table->string('purchaser_address')->nullable();
            $table->tinyInteger('purchaser_status')->default(1);
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
        Schema::dropIfExists('purchasers');
    }
}
