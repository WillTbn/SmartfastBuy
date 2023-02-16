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
            $table->string('person');
            $table->enum('genre',[1,2,3,4]);
            $table->string('birthday');
            $table->string('avatar')->nullable()->default(env('APP_URL_C').'/public/defatul-avatar.png');
            $table->enum('notifications',[1,2,3,4,5]);
            $table->foreignId('apartment_id')->constrained();
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
