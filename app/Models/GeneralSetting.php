<?php

namespace App\Models;

use App\Models\traits\ModelCommonFumctionality;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use ModelCommonFumctionality;
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
