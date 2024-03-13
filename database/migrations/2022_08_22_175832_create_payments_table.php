<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tuition_book_id');
            $table->string('payment_for')->nullable();
            $table->string('payment_type')->nullable()->default('online'); // online or cash
            $table->double('amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->integer('registration_year_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
