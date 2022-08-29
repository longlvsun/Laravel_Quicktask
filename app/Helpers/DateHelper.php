<?php

use Carbon\Carbon;

if (!function_exists('format_date'))
{
    function format_date($date, string $format = 'd/m/Y H:i:s')
    {
        if ($date instanceof Carbon) {
            return $date->format($format);
        }

        return date_format(new DateTime($date), $format);
    }
}
