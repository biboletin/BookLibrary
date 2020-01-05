<?php
    include_once '../inc/classes/config.php';
    include_once '../inc/classes/filter.php';
    include_once '../inc/classes/session.php';
    include_once '../inc/classes/hash.php';
    include_once '../inc/classes/user.php';
    include_once '../inc/db/databaseConnector.php';
    \Biboletin\Session::start();

/**
 *
 */
    $filter = new \Biboletin\Filter();
/**
 *
 */
    $action = $filter->sanitizeInput(strtolower(trim($_POST['action'])));
/**
 *
 */
    $dbs = new \DataBaseConnector();
/**
 *
 */
    $mysqli = $dbs->setEngine('mysqli')->makeConnection();
/**
 *
 */
    $user = new \Biboletin\User($mysqli);
    $hash = new \Biboletin\StringHasher('crypt', \Biboletin\Config::get('hashing', 'salt'));
/**
 *
 */
    if(isset($_POST['first_name'])){
        $firstName = $filter->sanitizeInput($_POST['first_name']);
        $user->setFirstName($firstName);
    }
/**
 *
 */
    if(isset($_POST['last_name'])){
        $lastName = $filter->sanitizeInput($_POST['last_name']);
        $user->setLastName($lastName);
    }
/**
 *
 */
    if(isset($_POST['username'])){
        $username = $filter->sanitizeInput($_POST['username']);
        $user->setUsername($username);
    }
/**
 *
 */
    if(isset($_POST['email'])){
        $email = $filter->sanitizeInput($_POST['email']);
        $user->setEmail($email);
    }
/**
 *
 */
    if (isset($_POST['password'])) {
        $password = $hash->hashit($filter->sanitizeInput($_POST['password']));
        $user->setPassword($password);
    }
/**
 * Логин форма
 */
    if ($action === 'login') {
        $data = ['response' => false];
        if ($user->checkUserExists($username, $password) === true) {
            $data['response'] = true;
        }
        echo json_encode($data);
    }
/**
 * Форма за регистрация
 */
    if ($action === 'register') {
        $data['response'] = false;
        if ($user->checkUserExists($username, $password) === false) {
            $data['response'] = $user->addUser();
        }

        echo json_encode($data);
    }
/**
 * Извличане на данните на потребител от БД
 * при зареждане на "Edit profile"
 */
    if ($action === 'get_user_data') {
        $data['response'] = $user->getUser(\Biboletin\Session::get('user'));
        echo json_encode($data);
    }
/**
 * Промяна данните на потребител
 */
    if ($action === 'edit_profile') {
        $user->editUser();
    }