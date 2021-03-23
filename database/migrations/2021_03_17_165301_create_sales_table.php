<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('account_id')->nullable()->onDelete('cascade');
            $table->date('date'); //data de carregamento
            $table->date('date_pay'); // data prevista de pagamento ... ainda nao usada
            $table->unsignedBigInteger('crop_id')->nullable(); 
            $table->unsignedBigInteger('ground_id')->nullable();  //area da fazenda
            $table->unsignedBigInteger('type_account_id')->nullable(); // "3" vendas
            $table->double('amount',10,2);  // quantidade
            $table->text('unity',5);  // unidade
            $table->double('price_unit',10,2);
            $table->unsignedBigInteger('bayer_id')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
