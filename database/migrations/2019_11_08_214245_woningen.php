<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Woningen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('woningen', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('titel')->nullable();
            $table->string('straat')->nullable();
            $table->integer('huisnummer');
            $table->string('postcode');
            $table->string('woonplaats');
            $table->string('bijvoegsel')->nullable();
            $table->boolean('huurwoning');
            $table->integer('prijs');
            $table->string('soortwoning');
            $table->string('hoofdfoto')->nullable();
            $table->integer('oppervlakte')->nullable();
            $table->integer('kamers')->nullable();
            $table->integer('slaapkamers')->nullable();
            $table->boolean('parkeerplaats')->nullable();
            $table->date('beschikbaarper')->nullable();
            $table->boolean('gestoffeerd')->nullable();
            $table->string('linkorigineleadvertentie');
            $table->string('linkwebsite');
            $table->integer('bronnenid')->unsigned();
			$table->foreign('bronnenid')->references('id')->on('bronnen');
            $table->boolean('actief');
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
        Schema::dropIfExists('woningen');
    }
}
