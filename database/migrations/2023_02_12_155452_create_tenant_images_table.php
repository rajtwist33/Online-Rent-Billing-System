<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_images', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tenant_id')->unsigned()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->string('image_path')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('tenant_images');
    }
};
