<?php

use NumberFormatter;
use Illuminate\Support\HtmlString;

/**
 * Generate random color gradient background
 */
if (!function_exists('randomHexColor')) {
    function randomHexColor(): string
    {
        return sprintf("#%06x", rand(0, 16777215));
    }
}

if (!function_exists('randomGradient')) {
    function randomGradient()
    {
        $color1 = sprintf("#%06x", rand(0, 16777215));
        $color2 = sprintf("#%06x", rand(0, 16777215));
        $angle = rand(1, 360);
        $gradient = "background: linear-gradient({$angle}deg, {$color1}, {$color2})";
        return $gradient;
    }
}

if (!function_exists('gravatarImg')) {
    function gravatarImg(string $name)
    {
        $gravatarId = md5(strtolower(trim($name)));

        return new HtmlString('<img src="https://gravatar.com/avatar/' . $gravatarId . '?s=240">');
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($size, $precision = 2)
    {
        $base = log((float) $size, 1024);
        $suffixes = ['', 'K', 'M', 'G', 'T'];

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
}


if (!function_exists('money')) {
    function money($input, $showCents = true, $locale = null)
    {
        setlocale(LC_MONETARY, $locale ?: locale_get_default());

        $numberOfDecimalPlaces = $showCents ? 2 : 0;

        $formatter = numfmt_create('en_US', NumberFormatter::CURRENCY);
        $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $numberOfDecimalPlaces);

        return numfmt_format_currency($formatter, $input, trim(localeconv()['int_curr_symbol']));
    }
}
