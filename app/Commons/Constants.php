<?php

namespace App\Commons;

class Constants
{
    private static $_DEFAULT_AVATAR = '/imgs/user.jpg';
    private static $_DEFAULT_COVER = '/imgs/user.jpg';
    private static $_WEB_NAME = 'Cookie Crumble';
    private static $_CHO_MEO_CANH = 21;
    private static $_THUC_AN_THU_CUNG = 22;
    private static $_DIFFERENT = [21, 25];
    public static function DEFAULT_AVATAR()
    {
        return self::$_DEFAULT_AVATAR;
    }
    public static function DEFAULT_COVER()
    {
        return self::$_DEFAULT_COVER;
    }
    public static function CHO_MEO_CANH()
    {
        return self::$_CHO_MEO_CANH;
    }
    public static function THUC_AN_THU_CUNG()
    {
        return self::$_THUC_AN_THU_CUNG;
    }
    public static function DIFFERENT()
    {
        return self::$_DIFFERENT;
    }
    public static function WEBNAME()
    {
        return self::$_WEB_NAME;
    }
}
