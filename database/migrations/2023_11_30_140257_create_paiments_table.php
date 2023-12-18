<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaimentsTable extends Migration
{
    public function up()
    {
        Schema::create('paiments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facture_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');; // Assuming you have a 'factures' table
            $table->date('date');
            $table->decimal('montant', 10, 2);
            $table->text('note')->nullable();
            $table->string('method')->nullable();
            $table->integer('numero')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiments');
    }
}
