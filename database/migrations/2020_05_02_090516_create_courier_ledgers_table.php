<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courier_id');
            $table->string('details')->nullable();
            $table->float('selling_price', 8, 2)->nullable();
            $table->float('debit', 8, 2)->nullable();
            $table->float('credit', 8, 2)->nullable();
            $table->float('balance', 8, 2)->nullable();
            $table->foreign('courier_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('courier_ledgers');
    }
}
