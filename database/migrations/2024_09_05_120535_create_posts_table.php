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
        Schema::create('posts', function (Blueprint $table) {
            $table->collation = 'utf8mb4_unicode_ci';
            $table->charset = 'utf8mb4';

            $table->integer('id', true);
            $table->integer('lawyer_id')->nullable();
            $table->integer('law_firm_id')->nullable();
            $table->integer('blog_category_id')->nullable();
            $table->longText('name')->nullable();
            $table->longText('description')->collation('utf8mb4_czech_ci')->nullable();
            $table->longText('slug')->nullable();
            $table->integer('is_active')->default(1);
            $table->boolean('is_featured')->nullable()->default(false);
            $table->boolean('is_community_post')->nullable()->default(false);
            $table->tinyInteger('is_shared')->default(0);
            $table->integer('share_with')->nullable();
            $table->longText('shared_description')->nullable();
            $table->string('image')->nullable();
            $table->longText('video')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
