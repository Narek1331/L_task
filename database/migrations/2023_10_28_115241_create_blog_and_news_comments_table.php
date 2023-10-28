<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_and_news_comments', function (Blueprint $table) {
            $table->unsignedBiginteger('user_id')->unsigned();
            $table->unsignedBiginteger('blog_news_id')->unsigned();
            $table->longText('text');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->foreign('blog_news_id')
            ->references('id')
            ->on('blog_and_news')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_and_news_comments');
    }
};
