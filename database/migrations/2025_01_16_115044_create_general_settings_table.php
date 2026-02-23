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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->unique('name');
            $table->string('display_name');
            $table->text('value')->nullable();
            $table->tinyInteger('is_protected')->default(0);
            $table->integer('is_specific')->default(0);
            $table->tinyInteger('is_multilang')->default(0);
            $table->string('type')->nullable();
            $table->string('page')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
};
