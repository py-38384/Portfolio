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
        Schema::create('frontends', function (Blueprint $table) {
            $table->id();
            $table->text('theme_colors')->nullable();
            $table->string('current_theme_color')->nullable();
            $table->string('name')->nullable();
            $table->string('hero_brief')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('portfolio_title')->nullable();
            $table->string('portfolio_desc')->nullable();
            $table->string('about_title')->nullable();
            $table->string('about_desc')->nullable();
            $table->string('about_image')->nullable();
            $table->string('about_story_title')->nullable();
            $table->text('about_story')->nullable();
            $table->text('about_skills_image')->nullable();
            $table->text('about_button_text')->nullable();
            $table->text('blog_title')->nullable();
            $table->text('blog_desc')->nullable();
            $table->text('contact_title')->nullable();
            $table->text('contact_desc')->nullable();
            $table->text('contact_image')->nullable();
            $table->text('copyright_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontends');
    }
};
