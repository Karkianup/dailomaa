<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('email');
            $table->string('telephone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('fax')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('skype')->nullable();
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->text('meta_description');
            $table->string('logo');
            $table->string('default_image');
            $table->string('site_url');
            $table->longText('google_maps');
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
        Schema::dropIfExists('site_settings');
    }
}
