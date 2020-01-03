<?php
namespace Biboletin;

class Config
{
    private static $config = [
        "mysql" => [
            "host" => "127.0.0.1",
            "user" => "root",
            "password" => "",
            "database" => "book_library",
            "port" => 3306,
        ],
    ];

    public static function get($key, $value): string
    {
        if (!isset(self::$config[$key])) {
            return "";
        }
        if (!isset(self::$config[$key][$value])) {
            return "";
        }
        return self::$config[$key][$value];
    }
}
