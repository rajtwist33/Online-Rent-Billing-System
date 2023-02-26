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
        Schema::create('electricitybillpayment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('room_id')->unsigned()->index();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->bigInteger('tenant_id')->unsigned()->index();
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->string('opening_unit')->nullable();
            $table->string('closing_unit')->nullable();
            $table->string('total_unit')->nullable();
            $table->string('amount_tobe_paid')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('dues_amount')->nullable();
            $table->string('advance_amount')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('electricitybillpayment');
    }
};
