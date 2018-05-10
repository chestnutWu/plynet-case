<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number',25);//訂單編號
            $table->string('name');//訂購人姓名
            $table->string('address');//訂購人聯絡地址
            $table->string('tel');//訂購人連絡電話
            $table->string('email');//訂購人信箱
            $table->timestamps();//訂單日期時間
            $table->date('ended_at');//匯款截止日期
            $table->string('status');//訂單狀態
            $table->string('item');//訂購項目
            $table->integer('number');//訂購數量
            $table->unique(['order_number'],'order_number_uk');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
