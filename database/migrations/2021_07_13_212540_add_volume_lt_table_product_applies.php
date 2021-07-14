<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVolumeLtTableProductApplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_applies', function (Blueprint $table) {
            $table->integer('volume_lt') // Nome da coluna
            ->after('amount'); // Ordenado após a coluna "user_id"  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_applies', function (Blueprint $table) {
            $table->dropColumn('volume_lt');
        });
    }
}
