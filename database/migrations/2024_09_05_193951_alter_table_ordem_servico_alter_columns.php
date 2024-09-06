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
            $table->dropColumn('pecas_utilizadas');
            $table->string('numero_motor', 300)->nullable();
            DB::statement("ALTER TABLE ordem_servicos ALTER COLUMN valor TYPE decimal(10, 2) USING (valor::decimal(10, 2))");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ordem_servicos', function (Blueprint $table) {
            $table->string('pecas_utilizadas');
            $table->dropColumn('numero_motor');
            DB::statement("ALTER TABLE ordem_servicos ALTER COLUMN valor TYPE text USING valor::text");
        });
    }
};
