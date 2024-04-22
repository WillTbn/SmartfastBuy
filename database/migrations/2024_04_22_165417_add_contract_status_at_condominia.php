<?php

use App\Enums\ContractStates;
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
            // dd(ContractStates::forSelectName());
            $table->enum('contract_status', ContractStates::forSelectName())->default(ContractStates::Draft->value);
        });
    }
    public function down(): void
    {
        Schema::table('condominias', function (Blueprint $table) {
            $table->dropColumn('contract_status');
        });
    }
};
