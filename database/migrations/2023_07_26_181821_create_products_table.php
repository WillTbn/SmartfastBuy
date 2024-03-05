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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('barcode');
            // $table->integer('quantity');
            $table->string('sku')->nullable()->unique();
            $table->float('value');
            $table->string('type');
            $table->foreignId('condominia_id')->constrained()->onDelete('set null');
            $table->foreignId('category_id')->constrained()->onDelete('set null');
            $table->foreignId('user_id')->constrained()->onDelete('set null');
            $table->string('description')->nullable();
            $table->string('image_one')->nullable()->default('default-illustrative.png')->after('value');
            $table->string('image_two')->nullable()->after('image_one');
            $table->string('image_three')->nullable()->after('image_two');
            // $table->float('value');
            // $table->foreignId('account_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
