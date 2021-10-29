<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceUnitConsTableFertilizerEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fertilizer_entries', function (Blueprint $table) {
            $table->double('price_unit_cons',10,4) // Nome da coluna
            ->after('quantity_cons'); // Ordenado após a coluna "amount"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fertilizer_entries', function (Blueprint $table) {
            $table->dropColumn('price_unit_cons');
        });
    }
}
