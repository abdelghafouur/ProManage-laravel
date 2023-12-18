<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('codeClient')->unique()->nullable();
            $table->string('nom');
            $table->enum('type', ['Entreprise', 'Particulier', 'Autre']);
            $table->text('adresse')->nullable();
            $table->integer('ice')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
