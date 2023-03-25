<?php

namespace App\Commons\CodeMasters;

class AccountType {
    private static $_VIP = 0;
    private static $_NORMAL = 1;
    public static function VIP() {
        return self::$_VIP;
    }
    public static function NORMAL() {
        return self::$_NORMAL;
    }
    public static function toArray() {
        return [
            self::$_VIP => __('Vip'),
            self::$_NORMAL => __('Normal')
        ];
    }
}
