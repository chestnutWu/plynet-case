<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'travel_info';//資料表名稱
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
