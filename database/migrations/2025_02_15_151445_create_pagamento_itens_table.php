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
        Schema::create('pagamento_itens', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor_item', 10, 2);
            $table->foreignIdFor(\App\Models\Cliente::class, 'cliente_id')->nullable();
            $table->foreignIdFor(\App\Models\OrdemServico::class, 'ordem_servico_id')->nullable();
            $table->foreignId('pagamento_id')->constrained('pagamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamento_itens');
    }
};
