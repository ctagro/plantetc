<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityConsTableFertilizerEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fertilizer_entries', function (Blueprint $table) {
            $table->double('quantity_cons',10,2) // Nome da coluna
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
        Schema::table('fertilizer_entries', function (Blueprint $table) {
            $table->dropColumn('quantity_cons');
        });
    }
}
