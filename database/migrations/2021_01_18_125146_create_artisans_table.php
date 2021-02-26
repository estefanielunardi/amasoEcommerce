<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtisansTable extends Migration
{
    
    public function up()
    {
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();           
            $table->timestamps();
            $table->string('location');
            $table->text('description');
            $table->string('image')->nullable();
            $table->boolean('aproved')->default(true);
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('artisans');
    }
}
