<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'travel_items';//資料表名稱
    protected $primaryKey = 'id';
    protected $fillable = [
        "title",
        "picture",
        "introduction",
        "content",
        "editor_input",
        "hypertext"
    ];
}
