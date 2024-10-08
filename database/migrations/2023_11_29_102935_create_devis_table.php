<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('entreprise_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreignId('banque_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('codeDevis')->unique()->nullable();
            $table->string('designationDev')->nullable();
            $table->string('conditionsDeReglement')->nullable();
            $table->date('date')->nullable();
            $table->string('devis')->nullable();
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
        Schema::dropIfExists('devis');
    }
}
