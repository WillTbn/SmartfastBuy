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
        Schema::table('address_condominias', function (Blueprint $table) {
            // $table->foreignId('condominia_id')->constrained()->onDelete('cascade');
            $table->foreignId('condominia_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('address_condominias', function (Blueprint $table) {
            $table->dropColumn('condominia_id');
        });
    }
};
