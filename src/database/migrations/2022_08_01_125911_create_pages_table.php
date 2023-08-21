<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('pages_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('locale', 8)->index();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->unique(['page_id', 'locale']);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->foreign('locale')->references('code')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_translations');
        Schema::dropIfExists('pages');
    }
}
