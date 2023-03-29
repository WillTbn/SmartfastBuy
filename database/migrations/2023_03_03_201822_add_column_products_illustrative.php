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
        Schema::table('products', function (Blueprint $table) {
            $table->string('image_one')->nullable()->default(env('APP_URL_C').'/defatul-illustrative.png')->after('value');
            $table->string('image_two')->nullable()->after('image_one');
            $table->string('image_three')->nullable()->after('image_two');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image_one');
            $table->dropColumn('image_two');
            $table->dropColumn('image_three');
        });
    }
};
