<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('codeFacture')->unique()->nullable();
            $table->foreignId('client_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('devis_id')->nullable()->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->date('date')->nullable();
            $table->string('devis');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
