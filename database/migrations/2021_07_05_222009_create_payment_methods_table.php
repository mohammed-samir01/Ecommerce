<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('driver_name')->unique();
            $table->string('merchant_email')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('secret')->nullable();
            $table->string('sandbox_merchant_email')->nullable();
            $table->string('sandbox_username')->nullable();
            $table->string('sandbox_password')->nullable();
            $table->string('sandbox_secret')->nullable();
            $table->boolean('sandbox')->default(false);
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('payment_methods');
    }
}
