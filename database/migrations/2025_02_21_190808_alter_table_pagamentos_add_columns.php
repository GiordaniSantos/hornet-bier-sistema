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
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->smallInteger('tipo_taxa')->nullable()->after('tipo');
            $table->decimal('valor_taxa', 10, 2)->nullable()->after('tipo_taxa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->dropColumn('tipo_taxa');
            $table->dropColumn('valor_taxa'); 
        });
    }
};
