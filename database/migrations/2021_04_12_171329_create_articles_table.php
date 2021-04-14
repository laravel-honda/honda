<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            collect([
                $table->string('season'),
                $table->unsignedBigInteger('main_ingredient'),
                $table->unsignedBigInteger('banner_image'),
                $table->unsignedBigInteger('author_id'),
                $table->unsignedBigInteger('category_id'),
                $table->text('content'),
                $table->string('making_time'),
                $table->boolean('draft')->default(true),
                $table->dateTime('publishes_at'),
                $table->json('illustrations'),
            ])->map->nullable();

            $table->timestamps();
        });
    }
}
