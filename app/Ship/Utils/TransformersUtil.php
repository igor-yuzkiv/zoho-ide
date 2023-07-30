<?php

namespace App\Ship\Utils;
use Illuminate\Support\Carbon;
class TransformersUtil
{
    public static function dateTimeFormatted(Carbon $carbon):string {
        if ($carbon->diffInHours() >= 24) {
            return  $carbon->format("M d, Y");
        }else {
            return $carbon->diffForHumans();
        }
    }
}
