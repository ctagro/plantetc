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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('name',50);
            $table->text('description',200);
            $table->text('type_product',50);  // inativo 07/03/21
            $table->text('packing',50); // tipo de embalagem// 
            $table->text('unity',10); 
            $table->double('price',10,2);
            $table->double('price_unit',10,4);
            $table->string('image', 100)->nullable();
            $table->enum('in_use',['S','N'])->default("S");
            $table->longtext('note');
            $table->timestamps();
            $table->softDeletes();
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
