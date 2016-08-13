<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFulfilledColumnAndDropImdbidColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function ($table) {
            $table->dropColumn('imdbid');
            $table->tinyInteger('fulfilled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function ($table) {
            $table->string('imdbid');
            $table->dropColumn('fulfilled');
        });
    }
}
