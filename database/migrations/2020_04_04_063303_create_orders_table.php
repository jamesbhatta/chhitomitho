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
            $table->string('billing_name');
            $table->string('billing_phone');
            $table->string('billing_address');
            $table->string('payment_option');
            $table->dateTime('transaction_time')->nullable();
            $table->text('order_notes')->nullable();
            $table->ipAddress('customer_ip')->nullable();
            $table->integer('total_price');
            $table->string('status')->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('courier_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('courier_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
