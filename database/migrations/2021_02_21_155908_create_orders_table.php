<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->longText('random_id');
            $table->longText('transaction_id');
            $table->longText('user_type');
            $table->bigInteger('payment_id');
            $table->bigInteger('total_quantity');
            $table->bigInteger('total_amount');
            $table->integer('status');
            $table->boolean('payment_status');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->date('delivery_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
