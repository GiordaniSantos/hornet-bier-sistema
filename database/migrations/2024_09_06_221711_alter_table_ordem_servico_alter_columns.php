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
        Schema::table('ordem_servicos', function (Blueprint $table) {
            $table->dropColumn('descricao_servico');
            $table->decimal('valor_total', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            $table->string('descricao_servico')->nullable();
            $table->dropColumn('valor_total');
        });
    }
};
