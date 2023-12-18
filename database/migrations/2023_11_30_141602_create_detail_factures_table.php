<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailFacturesTable extends Migration
{
    public function up()
    {
        Schema::create('detail_factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facture_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');; // Assuming you have a 'factures' table
            $table->string('designation');
            $table->decimal('puht', 10, 2);
            $table->integer('qte');
            $table->integer('tva');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_factures');
    }
}
