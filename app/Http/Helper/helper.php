<?php
if (!function_exists('replaceSpecialChar')) {
    function replaceSpecialChar($String = '')
    {
        return ucfirst(str_replace('_', ' ', $String));
    }
}
if (!function_exists('formatPrice')) {
    function formatPrice($price = '', $ext = "đ")
    {
        return number_format($price, 0, ",", ".") . $ext;
    }
}
