<?php


namespace Biboletin;

/**
 * Class User
 * @package Biboletin
 */
class User
{
    /**
     * @var
     */
    private $username;
    /**
     * @var
     */
    private $firstName;
    /**
     * @var
     */
    private $lastName;
    /**
     * @var
     */
    private $email;
    /**
     * @var
     */
    private $password;
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $dbs;

    /**
     * User constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->dbs = $db;
    }

    /**
     * @param string $username
     */
    public function setUsername($username = ''): void
    {
        $this->username = $username;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName = ''): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName = ''): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $email
     */
    public function setEmail($email = ''): void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password = ''): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function geLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public function checkUserExists($username, $password): bool
    {
        $sql = "SELECT 
                    id
                FROM
                    users
                WHERE
                    username = '" . $username . "' AND `password` = '" . $password . "'";
        $result = $this->dbs->sqlQuery($sql);
        if (($result === false) || (empty($result))) {
            return false;
        }
        \Biboletin\Session::start();
        \Biboletin\Session::set('loggedIn', true);
        \Biboletin\Session::set('user', $result[0]['id']);
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function addUser(): bool
    {
        $sql = "INSERT INTO users(`username`, `first_name`, `last_name`, `password`, `email`) 
                    VALUES(
                        '" . $this->username . "', 
                        '" . $this->firstName . "', 
                        '" . $this->lastName . "', 
                        '" . $this->password . "', 
                        '" . $this->email . "'
                    )";
        $this->dbs->sqlQuery($sql);
        return $this->checkUserExists($this->username, $this->password);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getUser($id = 0): array
    {
        $sql = "SELECT 
                        username,
                        first_name,
                        last_name,
                        email 
                    FROM
                        users 
                    WHERE id = '" . $id . "'";
        return $this->dbs->sqlQuery($sql);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function editUser(): bool
    {
        $sql = "UPDATE 
                        users 
                    SET
                        username = '" . $this->username . "',
                        first_name = '" . $this->firstName . "',
                        last_name = '" . $this->lastName . "',";
        if (($this->password != '') || ($this->password != null)) {
            $sql .= "`password` = '" . $this->password . "',";
        }
        $sql .= "email = '" . $this->email . "'
                    WHERE id = '" . \Biboletin\Session::get('user') . "' 
                    LIMIT 1 ";
        return $this->dbs->sqlQuery($sql);
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->firstName = null;
        $this->lastName = null;
        $this->username = null;
        $this->email = null;
        $this->password = null;
        $this->dbs = null;
    }
}
