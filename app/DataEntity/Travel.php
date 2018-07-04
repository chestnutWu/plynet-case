<?php

namespace App\DataEntity;

use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    protected $table = 'travel_map';//資料表名稱
    protected $primaryKey = 'id';
    protected $fillable = [
        "name",
        "region",
        "icon",
        "classification",
        "address",
        "longitude",
        "latitude",
        "phone_number",
        "sales_tel",
        "content",
        "hypertext",
        "editor_input"
    ];
}