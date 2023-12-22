<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('logo')->nullable();
            $table->string('typelogo')->nullable()->default('jpg');
            $table->string('ice')->nullable();
            $table->integer('patente')->nullable();
            $table->integer('if')->nullable();
            $table->integer('cnss')->nullable();
            $table->string('tva')->nullable();
            $table->integer('rc')->nullable();
            $table->text('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('rib')->nullable();
            $table->string('banque')->nullable();
            $table->string('swift')->nullable();
            $table->string('iban')->nullable();
            $table->string('site')->nullable();
            $table->integer('default')->default(0)->nullable();
            $table->integer('validite')->nullable();
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
        Schema::dropIfExists('entreprises');
    }
}
