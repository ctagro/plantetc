<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizer_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('type_product_id')->nullable(); 
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('provide_id')->nullable();
            $table->double('quantity',10,2);
            $table->double('price_unit',10,4);
            $table->double('amount',10,2);
            $table->double('quantity_cons',10,2);
            $table->double('price_unit_cons',10,4);
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
        Schema::dropIfExists('fertilizer_entries');
    }
}
