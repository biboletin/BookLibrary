<?php


namespace Biboletin;

class User
{
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $id;
    private $dbs;

    public function __construct($db)
    {
        $this->dbs = $db;
    }

    public function setUsername($username = ''): void
    {
        $this->username = $username;
    }

    public function setFirstName($firstName = ''): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName = ''): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail($email = ''): void
    {
        $this->email = $email;
    }

    public function setPassword($password = ''): void
    {
        $this->password = $password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function geLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

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
