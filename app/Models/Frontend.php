<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
    protected $guarded = [];
    public static function getItem(){
        $item = self::find(1);
        if($item){
            return $item;
        }
        return self::create(['id' => 1]);
    }
}
