<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailDevisTable extends Migration
{
    public function up()
    {
        Schema::create('detail_devis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devis_id')->constrained()->onDelete('cascade')
            ->onUpdate('cascade'); // Assuming you have a 'devis' table
            $table->text('designation');
            $table->decimal('puht', 10, 2);
            $table->integer('qte');
            $table->integer('tva');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_devis');
    }
}
