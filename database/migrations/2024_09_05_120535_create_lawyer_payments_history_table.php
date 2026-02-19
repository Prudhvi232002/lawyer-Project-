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
        Schema::create('lawyer_payments_history', function (Blueprint $table) {
            $table->collation = 'utf8mb4_unicode_ci';
            $table->charset = 'utf8mb4';

            $table->integer('id', true);
            $table->integer('lawyer_id')->nullable();
            $table->integer('subscription_id')->nullable();
            $table->date('billing_date')->nullable();
            $table->string('payment_mode')->nullable()->default('recurring')->comment('recurring,manual');
            $table->integer('payment_method_id')->nullable();
            $table->longText('payment_credentials')->nullable();
            $table->double('amount')->nullable()->default(0);
            $table->timestamp('payment_date')->nullable();
            $table->integer('atempts')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('lawyer_payments_history');
    }
};
