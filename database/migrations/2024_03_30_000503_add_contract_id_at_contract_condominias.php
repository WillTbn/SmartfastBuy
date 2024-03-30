<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contract_condominias', function (Blueprint $table) {
            // $table->foreignId('condominia_id')->constrained()->onDelete('cascade');
            $table->foreignId('signature_id')->nullable()->constrained()->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::table('contract_condominias', function (Blueprint $table) {
            $table->dropColumn('signature_id');
        });
    }
};
