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
            $table->foreignId('responsible_id')->nullable()->constrained('accounts', 'id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condominias', function (Blueprint $table) {
            $table->dropColumn('responsible_id');
        });
    }
};
