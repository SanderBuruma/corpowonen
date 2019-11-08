<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bronnen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bronnen', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('naam');
            $table->string('linkwebsite');
            $table->integer('woningenactief');
            $table->integer('woningentotaal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bronnen');
    }
}
