<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        $email = env('ADMIN_EMAIL');
        $password = bcrypt(env('ADMIN_PASSWORD'));
        $person = "15222222224";
        DB::table('users')->insert([
            'name'=>'administrador',
            'email'=>$email,
            'password'=>$password,
            'type' => 'M'
        ]);
        DB::table('accounts')->insert([
            "person"=> $person,
            "genre"=> "O",
            "birthday"=> "1990-08-03",
            "notifications"=> "A",
            "user_id"=> "1",
            "updated_at"=> "2023-03-03T21:22:08.000000Z",
            "created_at"=> "2023-03-03T21:22:08.000000Z",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $email = env('ADMIN_EMAIL');
        $person = "15222222224";
        DB::delete('DELETE FROM users WHERE email=?', [$email]);
        DB::delete('DELETE FROM accounts WHERE person=?', [$person]);
    }
};
