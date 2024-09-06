<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordem_servico_pecas', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('quantidade');
            
            $table->unsignedBigInteger('ordem_servico_id');
            $table->unsignedBigInteger('peca_id');

            $table->foreign('ordem_servico_id')->references('id')->on('ordem_servicos');
            $table->foreign('peca_id')->references('id')->on('pecas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordem_servico_pecas');
    }
};
