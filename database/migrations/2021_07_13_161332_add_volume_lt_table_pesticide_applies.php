<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVolumeLtTablePesticideApplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesticide_applies', function (Blueprint $table) {
            $table->integer('volume_lt') // Nome da coluna
                    ->nullable() // Preenchimento não obrigatório
                    ->after('amount'); // Ordenado após a coluna "amount"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesticide_applies', function (Blueprint $table) {
            $table->dropColumn('volume_lt');
        });
    }
}
