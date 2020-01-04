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

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getUsername(): String
    {
        return $this->username;
    }

    public function getFirstName(): String
    {
        return $this->firstName;
    }

    public function geLastName(): String
    {
        return $this->lastName;
    }

    public function getEmail(): String
    {
        return $this->email;
    }

    public function getPassword(): String
    {
        return $this->password;
    }

    public function checkUserExists($username, $password)
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

    public function addUser()
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

    public function getUser($id = 0)
    {
        $sql = "SELECT 
                        username,
                        first_name,
                        last_name,
                        `password`,
                        email 
                    FROM
                        users 
                    WHERE id = '" . $id . "'";
        error_log($sql);
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
