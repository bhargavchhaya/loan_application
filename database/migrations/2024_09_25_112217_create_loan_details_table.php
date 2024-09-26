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
        Schema::create('loan_details', function (Blueprint $table) {
            $table->id();
            $table->integer('clientid');
            $table->integer('num_of_payment');
            $table->date('first_payment_date');
            $table->date('last_payment_date');
            $table->decimal('loan_amount', 9, 2); // Max 99 lacs
            $table->timestamp('created_at')->useCurrent()->index('idx_created_at');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_details');
    }
};
