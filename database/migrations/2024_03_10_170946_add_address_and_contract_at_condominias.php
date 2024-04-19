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
        Schema::table('condominias', function (Blueprint $table) {
            $table->foreignId('address_condominias_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('contract_condominia_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condominias', function (Blueprint $table) {
            $table->dropColumn('address_condominias_id');
            $table->dropColumn('contract_condominia_id');
        });
    }
};
