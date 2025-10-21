<?php

namespace App\Models;

use App\Models\traits\ModelCommonFumctionality;
use Illuminate\Database\Eloquent\Model;

class Frontend extends Model
{
    use ModelCommonFumctionality;
    protected $guarded = [];
}
