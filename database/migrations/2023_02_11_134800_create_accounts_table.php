<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('person');
            $table->string('telephone')->nullable();
            $table->string('phone')->nullable();
            $table->char('genre', 1);
            $table->string('birthday');
            $table->string('avatar')->nullable()->default('default-avatar.png');
            $table->char('notifications', 1);
            $table->foreignId('apartment_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
