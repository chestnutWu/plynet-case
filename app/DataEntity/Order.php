<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';//資料表名稱
    protected $primaryKey = 'id';
    protected $fillable = [
        "order_number",
        "name",
        "address",
        "tel",
        "email",
        "ended_at",
        "status",
        "item",
        "amount"
    ];
}