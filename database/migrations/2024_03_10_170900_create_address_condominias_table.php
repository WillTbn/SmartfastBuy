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
        Schema::create('address_condominias', function (Blueprint $table) {
            $table->id();
            $table->string('road');
            $table->integer('number')->nullable();
            $table->string('state');
            $table->string('district');
            $table->string('zip_code');
            $table->string('city');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_condominias');
    }
};
