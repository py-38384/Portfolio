<?php

namespace App\Library;

class EditorJsDataToHtmlService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    private function getTagAttributes($tagHtml, $tag = 'editorjs-style', $escaped = true)
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
    private function break_into_chunk($html, $tags = ['editorjs-style'])
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
    private function scan_text($html)
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
    private function getTableHtml($data)
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
    private function getBlockHtml($block)
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
            $html .= '<div class="download-container">';
            $html .= '<a href="' . $block->data->file->url . '" download class="download-btn">';
            $html .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">';
            $html .= '<path d="M.5 9.9v3.6h15V9.9H14v2.5H2V9.9H.5zm7.5-.6V1h-1v8.3L4.4 6.8 3.7 7.5 8 12l4.3-4.5-.7-.7L8 9.3z"/>';
            $html .= '</svg> ';
            $html .= htmlspecialchars($block->data->title ?? 'Download', ENT_QUOTES, 'UTF-8');
            $html .= '</a>';
            $html .= '</div>';

        }
        if ($block->type == 'html') {
            $html .= $block->data->value;
        }
        return $html;
    }
    function parse($data)
    {
        $json_data = json_decode($data);
        $blocks = $json_data->blocks;
        $html = '';
        foreach ($blocks as $key => $block) {
            $html .= $this->getBlockHtml($block);
        }
        return $html;
    }
}
