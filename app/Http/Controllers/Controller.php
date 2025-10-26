<?php

namespace App\Http\Controllers;

use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\traits\CommonFunctions;
use Illuminate\Support\Facades\View;

abstract class Controller
{
    use CommonFunctions;
    public function __construct(){
        $GeneralSetting = GeneralSetting::getItem();
        View::share('GeneralSetting', $GeneralSetting);
        $frontend = Frontend::getItem();
        $frontend->about_story_html = $this->EditorJsDataToHtml($frontend->about_story);
        View::share('frontend', $frontend);
    }
}
