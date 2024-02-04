<?php

namespace App\Helpers;

use Carbon\Carbon;

class DiscountFunctions {

    public static function timeLimitationChecker($startAt, $expireAt, $actionAt)
    {
        $parsedActionAt = Carbon::parse($actionAt);

        if($startAt != null && Carbon::parse($startAt)->gt($parsedActionAt))
        {
            return false;
        }
        else if($expireAt != null && Carbon::parse($expireAt)->lt($parsedActionAt))
        {
            return false;
        }

        return true;
    }
}