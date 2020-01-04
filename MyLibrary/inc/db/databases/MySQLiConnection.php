<?php

/**
 * Клас за свързване с база данни, чрез MySQLi
 *
 * @author BK
 */
class MySQLiConnection implements SQLQuery
{

    /**
     *
     * @var object
     */
    private static $instance;

    /**
     *
     * @var object
     */
    private static $connection;

    /**
     *
     */
    private function __construct()
    {
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     * Създаване на нова инстанция
     * @return object
     */
    public static function getInstance()
    {
        self::$instance = null;

        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Връзка с база данни
     *
     * @return object
     */
    public function getConnection()
    {
        if (!function_exists("mysqli_connect")) {
            die("Активирайте MySQLi разширението!");
        }

        self::$connection = new mysqli(
            \Biboletin\Config::get('mysql', 'host'),
            \Biboletin\Config::get('mysql', 'user'),
            \Biboletin\Config::get('mysql', 'password')
        );
        if (mysqli_connect_error()) {
            die("Грешка: " . mysqli_error(self::$connection));
        }

        if (!mysqli_select_db(self::$connection, \Biboletin\Config::get('mysql', 'database'))) {
            die("Грешка: " . mysqli_error(self::$connection));
        }
        self::$connection->query("SET CHARACTER SET " . \Biboletin\Config::get('mysql', 'charset'));
        return self::$connection;
    }

    /**
     * Изпълнява SQL заявка
     * Връща true или false при UPDATE и INSERT заявка
     *
     * Връща масив с данни при SELECT заявка
     *
     * @param string $sql SQL заявка
     * @return mixed
     */
    public function sqlQuery($sql)
    {
        if (($sql === null) || ($sql === "")) {
            throw new Exception('Празна заявка!');
        }
        $action = explode(' ', strtolower(trim($sql)));
        $result = [];

        if ($action[0] !== 'select') {
            return (bool) self::$connection->query($sql);
        }

        if ($action[0] === 'select') {
            $query = self::$connection->query($sql);

            while ($row = $query->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }
}
