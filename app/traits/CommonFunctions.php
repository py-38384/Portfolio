<?php

namespace App\traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

trait CommonFunctions
{
    function imageUpload($file, $fullpath, $old_image_full_path = null){
        $filename = '';
        if($old_image_full_path){
            if(file_exists($old_image_full_path)){
                try {
                    unlink($old_image_full_path);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        if($file){
            $image              = $file;
            $input['imagename'] = time().'.'.$image->extension();
            $file->move($fullpath, $input['imagename']);
            $filename           = $input['imagename'];
        }

        return $filename;
    }

    function imageUploadKeepOriginalName($file, $full_path, $only_name = false, $old_image_full_path = null){
        $filename_with_path = '';
        $image_name = '';
        if($old_image_full_path){
            if(file_exists($old_image_full_path)){
                try {
                    unlink($old_image_full_path);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        if($file){
            $image_name = $file->getClientOriginalName();
            $path_with_file_name = $full_path.'/'.$image_name;
            if(File::exists($path_with_file_name)){
                try {
                    $image_name = Str::random(10).'-'.$image_name;
                    $file->move($full_path, $image_name);
                } catch (\Throwable $th) {
                    return false;
                }
            } else {
                $file->move($full_path, $image_name);
            }
            $filename_with_path = $full_path.'/'.$image_name;
            if($only_name){
                return $image_name;
            }
            return ["success" => "image upload success","filename_with_path" => $filename_with_path, "image_name" => $image_name];
        }
        return [];
    }
    function fileDeleteLog($fileFullPath, $error = ''){
        if($error){
            Log::channel('file_delete')->info('File Delete successfully', [
                'filename' => $fileFullPath,
                'user_id' => auth()->id(),
            ]);
        } else {
            Log::channel('file_delete')->error('File Delete Failed', [
                'filename' => $fileFullPath,
                'user_id' => auth()->id(),
                'error_message' => $error
            ]);
        }
    }
    function fileDelete($path){
        try {
            unlink($path);
            $this->fileDeleteLog($path);
        } catch (\Throwable $th) {
            $this->fileDeleteLog($path, $th->getMessage());
            return 0;
        }
        return 1;
    }
    function batchDelete($files, $path = null){
        $deleteCount = 0;
        $failedCount = 0;
        if(is_array($files)){
            if($path){
                foreach($files as $file){
                    if(File::exists($path.$file)){
                        if($this->fileDelete($path.$file)){
                            $deleteCount++;
                        } else {
                            $failedCount++;
                        }
                    }
                }
            } else {
                foreach($files as $file){
                    if(File::exists($file)){
                        if($this->fileDelete($file)){
                            $deleteCount++;
                        } else {
                            $failedCount++;
                        }
                    }
                }
            }
            return ['success' => true, 'message' => 'Batch Delete Finished', 'deleteCount' => $deleteCount, 'failedCount' => $failedCount];
        } else {
            if($path){
                if(File::exists($path.$files)){
                    if($this->fileDelete($path.$files)){
                        $deleteCount = 1;
                    } else {
                        $failedCount = 1;
                    }
                }
            } else {
                if(File::exists($files)){
                    if($this->fileDelete($files)){
                        $deleteCount = 1;
                    } else {
                        $failedCount = 1;
                    }
                }
            }
            return ['success' => true, 'message' => 'Single File Delete Finished', 'deleteCount' => $deleteCount, 'failedCount' => $failedCount];
        }
        
    }
    function getBlockHtml($block){
        $html = '';
        if($block->type == 'paragraph'){
            $html .= "<p>{$block->data->text}</p>";
        }
        return $html;
    }
    function EditorJsDataToHtml($data){
        $json_date = json_decode($data);
        $blocks = $json_date->blocks;
        $html = '';
        foreach ($blocks as $key => $block) {
            $html .= $this->getBlockHtml($block);
        }
        return $html;
    }
    function randomRGB() {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgb($r, $g, $b)";
    }
}