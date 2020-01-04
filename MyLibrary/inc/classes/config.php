<?php
namespace Biboletin;

class Config
{
    private static $config = [
        'mysql' => [
            'host' => 'localhost',
            'user' => 'root',
            'password' => '',
            'database' => 'my_library',
            'port' => 3306,
            'charset' => 'utf8',
        ],
        'hashing' => [
            'salt' => 'MyLibrary'
        ]
    ];

    public static function get($key, $value): string
    {
        if (!isset(self::$config[$key])) {
            return '';
        }
        if (!isset(self::$config[$key][$value])) {
            return '';
        }
        return self::$config[$key][$value];
    }
}
