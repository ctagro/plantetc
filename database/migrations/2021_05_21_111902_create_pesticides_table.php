<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('name',50);
            $table->text('manufacturer',200);
            $table->text('active_principle_id',200); // relacionar 
            $table->longtext('application')->nullable();  
            $table->integer('grace_period')->nullable(); //relacionar
            $table->text('dosage',50)->nullable();
            $table->unsignedBigInteger('category_pesticide_id')->nullable();
            $table->text('packing',50)->nullable(); // tipo de embalagem//
            $table->text('unity',10)->nullable();
            $table->double('price',10,2)->nullable();
            $table->double('price_unit',10,2)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('medicine_insert', 100)->nullable();
            $table->enum('in_use',['S','N'])->default("S");
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
        Schema::dropIfExists('pesticides');
    }
}
