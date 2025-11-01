<?php

namespace App\traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

trait CommonFunctions
{
    function imageUpload($file, $fullpath, $old_image_full_path = null)
    {
        $filename = '';
        if ($old_image_full_path) {
            if (file_exists($old_image_full_path)) {
                try {
                    unlink($old_image_full_path);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        if ($file) {
            $image = $file;
            $input['imagename'] = time() . '.' . $image->extension();
            $file->move($fullpath, $input['imagename']);
            $filename = $input['imagename'];
        }

        return $filename;
    }

    function imageUploadKeepOriginalName($file, $full_path, $only_name = false, $old_image_full_path = null)
    {
        $filename_with_path = '';
        $image_name = '';
        if ($old_image_full_path) {
            if (file_exists($old_image_full_path)) {
                try {
                    unlink($old_image_full_path);
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        }
        if ($file) {
            $image_name = $file->getClientOriginalName();
            $path_with_file_name = $full_path . '/' . $image_name;
            if (File::exists($path_with_file_name)) {
                try {
                    $image_name = Str::random(10) . '-' . $image_name;
                    $file->move($full_path, $image_name);
                } catch (\Throwable $th) {
                    return false;
                }
            } else {
                $file->move($full_path, $image_name);
            }
            $filename_with_path = $full_path . '/' . $image_name;
            if ($only_name) {
                return $image_name;
            }
            return ["success" => "image upload success", "filename_with_path" => $filename_with_path, "image_name" => $image_name];
        }
        return [];
    }
    function fileDeleteLog($fileFullPath, $error = '')
    {
        if ($error) {
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
    function fileDelete($path)
    {
        try {
            unlink($path);
            $this->fileDeleteLog($path);
        } catch (\Throwable $th) {
            $this->fileDeleteLog($path, $th->getMessage());
            return 0;
        }
        return 1;
    }
    function batchDelete($files, $path = null)
    {
        $deleteCount = 0;
        $failedCount = 0;
        if (is_array($files)) {
            if ($path) {
                foreach ($files as $file) {
                    if (File::exists($path . $file)) {
                        if ($this->fileDelete($path . $file)) {
                            $deleteCount++;
                        } else {
                            $failedCount++;
                        }
                    }
                }
            } else {
                foreach ($files as $file) {
                    if (File::exists($file)) {
                        if ($this->fileDelete($file)) {
                            $deleteCount++;
                        } else {
                            $failedCount++;
                        }
                    }
                }
            }
            return ['success' => true, 'message' => 'Batch Delete Finished', 'deleteCount' => $deleteCount, 'failedCount' => $failedCount];
        } else {
            if ($path) {
                if (File::exists($path . $files)) {
                    if ($this->fileDelete($path . $files)) {
                        $deleteCount = 1;
                    } else {
                        $failedCount = 1;
                    }
                }
            } else {
                if (File::exists($files)) {
                    if ($this->fileDelete($files)) {
                        $deleteCount = 1;
                    } else {
                        $failedCount = 1;
                    }
                }
            }
            return ['success' => true, 'message' => 'Single File Delete Finished', 'deleteCount' => $deleteCount, 'failedCount' => $failedCount];
        }

    }


    function getTagAttributes($tagHtml, $tag = 'editorjs-style', $escaped = true)
    {
        if ($escaped) {
            $tagHtml = stripcslashes($tagHtml);
        }

        preg_match('/style="([^"]*)"/i', $tagHtml, $style);
        preg_match('/id="([^"]*)"/i', $tagHtml, $id);
        preg_match('/class="([^"]*)"/i', $tagHtml, $class);
        preg_match('/<' . $tag . '[^>]*>(.*?)<\/' . $tag . '>/is', $tagHtml, $inner);

        return [
            'style' => $style[1] ?? '',
            'id' => $id[1] ?? '',
            'class' => $class[1] ?? '',
            'inner' => $inner[1] ?? '',
        ];
    }
    function break_into_chunk($html, $tags = ['editorjs-style'])
    {
        $tagPattern = implode('|', array_map('preg_quote', $tags));
        $pattern = '/(<(?:' . $tagPattern . ')[^>]*>.*?<\/(?:' . $tagPattern . ')>)/is';

        $parts = preg_split($pattern, $html, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        $chunks = [];

        foreach ($parts as $part) {
            if (preg_match('/^<(' . $tagPattern . ')\b[^>]*>.*?<\/\1>$/is', $part, $match)) {
                $chunks[] = [
                    'type' => $match[1],
                    'content' => $part,
                ];
            } else {
                if (trim($part) !== '') {
                    $chunks[] = [
                        'type' => 'text',
                        'content' => $part,
                    ];
                }
            }
        }

        return $chunks;
    }
    function scan_text($html)
    {
        $generated_html = '';
        $chunks = $this->break_into_chunk($html);

        foreach ($chunks as $chunk) {
            if ($chunk['type'] == "text") {
                $generated_html .= $chunk['content'];
            }
            if ($chunk['type'] == "editorjs-style") {
                $tag_attributes = $this->getTagAttributes($chunk['content'], 'editorjs-style');
                $tag_html = '<span id="' . $tag_attributes['id'] . '" class="' . $tag_attributes['class'] . '" style="' . $tag_attributes['style'] . '">' . $tag_attributes['inner'] . '<span>';
                $generated_html .= $tag_html;
            }
        }
        return $generated_html;
    }
    function getTableHtml($data)
    {
        $html = '<table class="' .( $data->stretched ? 'table-stretched' : '') . '">';
        foreach ($data->content as $col_index => $column) {
            if ($col_index == 0 && $data->withHeadings) {
                $html .= "<tr>";
                foreach ($column as $cell) {
                    $html .= '<th>' . $this->scan_text($cell) . '</th>';
                }
                $html .= "</tr>";
            } else {
                $html .= "<tr>";
                foreach ($column as $cell) {
                    $html .= '<td>' . $this->scan_text($cell) . '</td>';
                }
                $html .= "</tr>";
            }
        }
        $html .= '</table>';
        return $html;
    }
    function getBlockHtml($block)
    {
        $html = '';
        if ($block->type == 'paragraph') {
            $html .= "<p>" . $this->scan_text($block->data->text) . "</p>";
        }
        if ($block->type == 'header') {
            if ($block->data->level == 1) {
                $html .= "<h1>" . $this->scan_text($block->data->text) . "</h1>";
            }
            if ($block->data->level == 2) {
                $html .= "<h2>" . $this->scan_text($block->data->text) . "</h2>";
            }
            if ($block->data->level == 3) {
                $html .= "<h3>" . $this->scan_text($block->data->text) . "</h3>";
            }
            if ($block->data->level == 4) {
                $html .= "<h4>" . $this->scan_text($block->data->text) . "</h4>";
            }
            if ($block->data->level == 5) {
                $html .= "<h5>" . $this->scan_text($block->data->text) . "</h5>";
            }
            if ($block->data->level == 6) {
                $html .= "<h6>" . $this->scan_text($block->data->text) . "</h6>";
            }
        }
        if ($block->type == 'List') {
            if ($block->data->style == 'unordered') {
                $html .= "<ul>";
                if (isset($block->data->items) && (count($block->data->items) > 0)) {
                    foreach ($block->data->items as $item) {
                        $html .= "<li>" . $this->scan_text($item->content) . "</li>";
                    }
                }
                $html .= "</ul>";
            }
            if ($block->data->style == 'ordered') {
                $html .= "<ol>";
                if (isset($block->data->items) && (count($block->data->items) > 0)) {
                    foreach ($block->data->items as $item) {
                        $html .= "<li>" . $this->scan_text($item->content) . "</li>";
                    }
                }
                $html .= "</ol>";
            }
            if ($block->data->style == 'checklist') {
                $html .= '<input type="checkbox"><span>';
                if (isset($block->data->items) && (count($block->data->items) > 0)) {
                    foreach ($block->data->items as $item) {
                        $html .= "<li>" . $this->scan_text($item->content) . "</li>";
                    }
                }
                $html .= "</span>";
            }
        }
        if ($block->type == 'image') {
            $html .= '<div class="image-container ' . ($block->data->withBackground ? "apply-background" : '') . ' ' . ($block->data->withBorder ? "apply-border" : '') . ' ' . ($block->data->stretched ? "apply-stretched" : '') . '">';
            $html .= '<img ';
            $html .= 'src="' . $block->data->file->url . '"';
            $html .= 'src="' . $block->data->caption . '"';
            $html .= '></div>';
        }
        if ($block->type == 'table') {
            $html .= $this->getTableHtml($block->data);
        }
        if ($block->type == 'code') {
            $escaped = htmlspecialchars($block->data->code, ENT_QUOTES, 'UTF-8');
            $html .= "<pre><code>{$escaped}</code></pre>";
        }
        if ($block->type == 'attaches') {
            $html .= '<a class="attachment" ';
            $html .= 'href="'.$block->data->file->url.'" ';
            $html .= 'download';
            $html .= '>';
            $html .= $block->data->title;
            $html .= '</a>';
        }
        if ($block->type == 'htmlview') {
            $html .= $block->data->html;
        }
        return $html;
    }
    function EditorJsDataToHtml($data)
    {
        $json_data = json_decode($data);
        $blocks = $json_data->blocks;
        $html = '';
        foreach ($blocks as $key => $block) {
            $html .= $this->getBlockHtml($block);
        }
        return $html;
    }
    function randomRGB()
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgb($r, $g, $b)";
    }
}