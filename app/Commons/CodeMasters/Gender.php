<?php

namespace App\Commons\CodeMasters;

class Gender {
    private static $_MALE = 10;
    private static $_FEMALE = 20;
    private static $_OTHER = 30;
    public static function MALE() {
        return self::$_MALE;
    }
    public static function FEMALE() {
        return self::$_FEMALE;
    }
    public static function OTHER() {
        return self::$_OTHER;
    }
    public static function toArray() {
        return [
            self::$_MALE => __('Male'),
            self::$_FEMALE => __('Female'),
            self::$_OTHER => __('Other')
        ];
    }
}
