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
        Schema::create('account_clients', function (Blueprint $table) {
            $table->string('person');
            $table->string('telephone')->nullable();
            $table->string('phone')->nullable();
            $table->char('genre', 1)->nullable()->default('O');
            $table->string('birthday');
            $table->string('avatar')->nullable()->default('default-avatar.png');
            $table->enum('notifications',['accepted', 'refused']);
            $table->foreignId('apartment_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_clients');
    }
};
