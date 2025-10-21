<?php

namespace App\Models\traits;

trait ModelCommonFumctionality
{
    public static function getItem(){
        $item = self::find(1);
        if($item){
            return $item;
        }
        return self::create(['id' => 1]);
    }
}
