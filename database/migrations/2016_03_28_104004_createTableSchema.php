<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = file_get_contents(__DIR__ . '/createTableSchema.sql');
        DB::unprepared($sql);
        
        $user = new App\Models\User();
        $user->role_id =2; // full admin
        $user->email ='paweelkopec@gmail.com';
        $user->password = bcrypt('paweelkopec@gmail.com');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('statistic');
        Schema::drop('files');
        Schema::drop('courses');
        Schema::drop('categories');
        Schema::drop('users');
        Schema::drop('roles');
        

    }
}
