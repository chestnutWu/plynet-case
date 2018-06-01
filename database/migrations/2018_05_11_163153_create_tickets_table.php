<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_number',25);//機票編號
            $table->string('region');//地區
            $table->string('topic');//促銷主題
            $table->date('depart_date');//航班出發日期
            $table->date('return_date');//航班回程日期
            $table->timestamps();//機票(創立、更新)時間
            $table->date('started_at');//匯款顯示日期
            $table->date('ended_at');//匯款顯示日期
            $table->string('sales_instruction');//售票說明
            $table->string('sales_tel');//訂票專線
            $table->string('content');//內容
            $table->unique(['ticket_number'],'ticket_number_uk');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
