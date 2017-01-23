<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoginLogoutDateToUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('user_logs', function($table) {
        $table->dateTime('login_date')->nullable();
        $table->dateTime('logout_date')->nullable();
    });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_logs', function($table) {
            $table->dropColumn('login_date');
            $table->dropColumn('logout_date');
        });
        
    }
}
