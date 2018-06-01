<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';//資料表名稱
    protected $primaryKey = 'id';
    protected $fillable = [
        "ticket_number",
        "region",
        "topic",
        "depart_date",
        "return_date",
        "started_at",
        "ended_at",
        "sales_instruction",
        "sales_tel",
        "price",
        "content",
        "editor_input",
        "hypertext"
    ];
}