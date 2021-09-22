<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticideInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticide_inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('type_product_id')->nullable(); 
            $table->unsignedBigInteger('pesticide_id')->nullable();
            $table->unsignedBigInteger('provide_id')->nullable();  
            $table->double('entry',10,2);
            $table->double('exit',10,2);
            $table->double('balance',10,2);
            $table->double('minimum_stock',10,2);
            $table->integer('status');
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
        Schema::dropIfExists('pesticide_inventories');
    }
}
