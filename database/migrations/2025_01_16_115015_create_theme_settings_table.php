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
        Schema::create('theme_settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name')->index('name');
            $table->string('color')->nullable();
            $table->string('display_name');
            $table->text('value')->nullable();
            $table->string('theme_code')->nullable();
            $table->tinyInteger('is_editable')->nullable();
            $table->tinyInteger('is_protected')->default(0);
            $table->integer('is_specific')->default(0);
            $table->tinyInteger('is_multilang')->default(0);
            $table->string('type')->nullable();
            $table->string('page')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('theme_settings');
    }
};
