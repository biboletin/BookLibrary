<?php
include_once '../inc/classes/config.php';
include_once '../inc/classes/filter.php';
include_once '../inc/classes/session.php';
include_once '../inc/classes/hash.php';
include_once '../inc/classes/user.php';
include_once '../inc/db/databaseConnector.php';
\Biboletin\Session::start();

$filter = new \Biboletin\Filter();
$action = $filter->sanitizeInput(strtolower(trim($_POST['action'])));
$dbs = new \DataBaseConnector();
$mysqli = $dbs->setEngine('mysqli')->makeConnection();

if ($action === 'login') {
    $hash = new \Biboletin\StringHasher('crypt', \Biboletin\Config::get('hashing', 'salt'));
    $username = $filter->sanitizeInput($_POST['username']);
    $password = $hash->hashit($filter->sanitizeInput($_POST['password']));

    $user = new \Biboletin\User($mysqli);
    $data = ['response' => false];
    if ($user->checkUserExists($username, $password) === true) {
        $data['response'] = true;
    }
    echo json_encode($data);
}

if ($action === 'register') {
    $user = new \Biboletin\User($mysqli);
    $hash = new \Biboletin\StringHasher('crypt', \Biboletin\Config::get('hashing', 'salt'));
    $firstName = $filter->sanitizeInput($_POST['first_name']);
    $lastName = $filter->sanitizeInput($_POST['last_name']);
    $username = $filter->sanitizeInput($_POST['username']);
    $password = $hash->hashit($filter->sanitizeInput($_POST['password']));
    $email = $filter->sanitizeInput($_POST['email']);
    $user->setFirstName($firstName);
    $user->setLastName($lastName);
    $user->setUsername($username);
    $user->setEmail($email);
    $user->setPassword($password);
    $data['response'] = false;
    if ($user->checkUserExists($username, $password) === false) {
        $data['response'] = $user->addUser();
    }

    echo json_encode($data);
}
