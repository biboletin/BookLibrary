<?php

/**
 * ���� �� ��������� � ���� �����, ���� MySQLi
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
     * ��������� �� ���� ���������
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
     * ������ � ���� �����
     *
     * @return object
     */
    public function getConnection()
    {
        if (!function_exists("mysqli_connect")) {
            die("����������� MySQLi ������������!");
        }

        self::$connection = new mysqli(
            \Biboletin\Config::get('mysql', 'host'),
            \Biboletin\Config::get('mysql', 'user'),
            \Biboletin\Config::get('mysql', 'password')
        );
        if (mysqli_connect_error()) {
            die("������: " . mysqli_error(self::$connection));
        }

        if (!mysqli_select_db(self::$connection, \Biboletin\Config::get('mysql', 'database'))) {
            die("������: " . mysqli_error(self::$connection));
        }
        self::$connection->query("SET CHARACTER SET " . \Biboletin\Config::get('mysql', 'charset'));
        return self::$connection;
    }

    /**
     * ��������� SQL ������
     * ����� true ��� false ��� UPDATE � INSERT ������
     *
     * ����� ����� � ����� ��� SELECT ������
     *
     * @param string $sql SQL ������
     * @return mixed
     */
    public function sqlQuery($sql)
    {
        if (($sql === null) || ($sql === "")) {
            throw new Exception('������ ������!');
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
