<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticideAppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticide_applies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('account_id')->nullable()->onDelete('cascade');
            $table->date('date');
            $table->unsignedBigInteger('pesticide_id')->nullable(); 
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->unsignedBigInteger('accounting_id')->nullable();
            $table->unsignedBigInteger('ground_id')->nullable();
            $table->double('amount',10,2);
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
        Schema::dropIfExists('pesticide_applies');
    }
}
