<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHypertextAndEditorInputToNewsTable extends Migration
{
    public function up()
    {
        Schema::table('latest_news', function (Blueprint $table) {
            $table->string('hypertext')->nullable()->after('content');
            $table->longText('editor_input')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::table('latest_news', function (Blueprint $table) {
            $table->dropColumn('hypertext');
            $table->dropColumn('editor_input');
        });
    }
}
