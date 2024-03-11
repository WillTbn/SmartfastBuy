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
        Schema::create('contract_condominias', function (Blueprint $table) {
            $table->id();
            $table->string('document_name')->default('default-contract.pdf');
            $table->date('initial_date')->nullable();
            $table->date('final_date')->nullable();
            // $table->enum('status', ['initial', 'accepted', ''])
            // DOCUMENTAÇÂO não pode ser deletado usuario pai,
            // caso usuário seja desvinculado passa responsabilidade para outro.
            // cria softdelete na tabela account
            $table->unsignedBigInteger('ceo_id')->nullable();
            $table->unsignedBigInteger('responsible_id')->nullable();

            $table->foreign('ceo_id')->references('id')->on('accounts')->onDelete('set null');
            $table->foreign('responsible_id')->references('id')->on('accounts')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_condominias');
    }
};
