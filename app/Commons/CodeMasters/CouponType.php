<?php

namespace App\Commons\CodeMasters;

class CouponType {
    private static $_PERCENT = 1;
    private static $_MONEY = 2;
    public static function PERCENT() {
        return self::$_PERCENT;
    }
    public static function MONEY() {
        return self::$_MONEY;
    }
    public static function toArray() {
        return [
            self::$_PERCENT => __('%'),
            self::$_MONEY => __('VNĐ')
        ];
    }
}
