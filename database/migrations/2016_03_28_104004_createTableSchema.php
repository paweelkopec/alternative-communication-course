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
        // split the statements, so DB::statement can execute them.
//        $statements = array_filter(array_map('trim', explode(';', $sql)));
//        foreach ($statements as $stmt) {
//            DB::statement($stmt);
//        }
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
