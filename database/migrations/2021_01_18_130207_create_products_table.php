<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image')->nullable();
            $table->text('description');
            $table->integer('price');
            $table->integer('stock');
            $table->integer('sold');
            $table->string('typequantity');
            $table->unsignedBigInteger('artisan_id');
            $table->foreign('artisan_id')->references('id')->on('artisans')->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('category');
            $table->boolean('highlight')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
