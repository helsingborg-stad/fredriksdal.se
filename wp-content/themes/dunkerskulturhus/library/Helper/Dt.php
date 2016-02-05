<?php

namespace Dunkers\Helper;

class Dt
{
    public static function toStringFormat($time)
    {
        return date('j F Y \k\l\. H:i', $time);
    }

    public static function dateWithTime($time)
    {
        return date('Y-m-d \k\l\. H:i', $time);
    }
}
