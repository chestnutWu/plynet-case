<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEndedAtToLatestNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //add ended_date column
        Schema::table('latest_news', function (Blueprint $table) {
            $table->date('ended_at')->after('updated_at')->default('2099-12-31');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //delete ended_date column
        Schema::table('latest_news', function (Blueprint $table) {
            $table->dropColumn('ended_at');
        });
    }
}
