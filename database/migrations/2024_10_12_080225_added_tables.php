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
        // Объявления
        Schema::create('adboards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('rate')->default(0);
            $table->integer('cnt_views')->default(0);
            $table->boolean('active')->default(false);
            $table->boolean('premium')->default(false);
            $table->integer('price')->default(0);
            $table->json('tags')->nullable();
            $table->json('location')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('comment_id')->references('id')->on('feedbacks');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('specialization_id')->references('id')->on('specializations');
            $table->timestamps(); // Добавляем метки времени
        });

        // Специализации
        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Отзывы к объявлениям
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->integer('rate')->default(5);
            $table->integer('author')->default(0);
            $table->timestamps();
        });

        Schema::create('specialization_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adboards');
        Schema::dropIfExists('specializations');
        Schema::dropIfExists('specialization_user');
        Schema::dropIfExists('feedbacks');
    }
};
