<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('main_image');
            $table->longText('image');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->bigInteger('sku_code');
            $table->boolean('is_featured');
            $table->bigInteger('regular_price');
            $table->bigInteger('sale_price');
            $table->bigInteger('wholesaler_price');
            $table->bigInteger('shipping_price')->default(0);
            $table->bigInteger('allowed_quantity')->default(0);
            $table->bigInteger('total');
            $table->bigInteger('retailer_id');
            $table->longText('description');
            $table->longText('additional_information')->nullable();
            $table->longText('meta_description');
            $table->boolean('status');
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
        Schema::dropIfExists('products');
    }
}
