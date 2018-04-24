<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class LatestNews extends Model
{
    protected $table = 'latest_news';//資料表名稱
    protected $primaryKey = 'id';
    protected $fillable = [
        "title",
        "classification",
        "picture",
        "introduction",
        "content",
        "editor_input",
        "hypertext",
        "ended_at"
    ];
}