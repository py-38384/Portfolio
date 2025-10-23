<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    protected $casts = ['tags' => 'array'];
}
