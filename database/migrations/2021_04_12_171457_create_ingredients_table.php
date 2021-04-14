<?php

use App\Models\Ingredient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', array_keys(Ingredient::TYPES));
            $table->boolean('contains_gluten')->default(false);
            $table->boolean('contains_lactose')->default(false);
            $table->timestamps();
        });
    }
}
