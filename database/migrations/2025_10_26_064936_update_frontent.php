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
        Schema::table('frontends', function (Blueprint $table) {
            $table->integer('projects_in_home');
            $table->integer('blogs_in_home');
            $table->string('about_youtube_video_id')->nullable();
            $table->string('about_button_link')->nullable();
            $table->string('testimonial_title')->nullable();
            $table->string('testimonial_desc')->nullable();
            $table->string('portfolio_page_title')->nullable();
            $table->string('portfolio_page_desc')->nullable();
            $table->string('about_page_title')->nullable();
            $table->string('about_page_desc')->nullable();
            $table->string('blog_page_title')->nullable();
            $table->string('blog_page_desc')->nullable();
            $table->string('contact_page_title')->nullable();
            $table->string('contact_page_desc')->nullable();
            $table->string('contact_page_full_address')->nullable();
            $table->string('contact_page_email')->nullable();
            $table->string('contact_page_phone_number')->nullable();
            $table->integer('project_per_page');
            $table->integer('blogs_per_page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('frontends', function (Blueprint $table) {
            //
        });
    }
};
