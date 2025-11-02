<?php

function getTextColorBasedOnBackground($bgColor)
{
    // Remove '#' if present
    $bgColor = ltrim($bgColor, '#');

    // Convert shorthand like "abc" → "aabbcc"
    if (strlen($bgColor) == 3) {
        $bgColor = $bgColor[0] . $bgColor[0] . $bgColor[1] . $bgColor[1] . $bgColor[2] . $bgColor[2];
    }

    // Convert hex to RGB
    $r = hexdec(substr($bgColor, 0, 2));
    $g = hexdec(substr($bgColor, 2, 2));
    $b = hexdec(substr($bgColor, 4, 2));

    // Calculate luminance using the formula for perceived brightness
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

    // Return text color: white for dark backgrounds, black for light
    return $luminance > 0.5 ? '#000000' : '#FFFFFF';
}