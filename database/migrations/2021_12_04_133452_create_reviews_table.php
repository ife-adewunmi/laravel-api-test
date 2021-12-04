<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Hotel::class);
            $table->string('title', 200);
            $table->text('description');
            $table->unsignedDecimal('rating', 2, 1);
            $table->string('author', 100);
            $table->timestamp('created_at')->useCurrent();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
