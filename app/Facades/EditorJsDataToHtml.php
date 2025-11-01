<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class EditorJsDataToHtml extends Facade
{
    protected static function getFacadeAccessor(){
        return 'editor_js_data_to_html_service';
    }
}
