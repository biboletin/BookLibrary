<?php
include_once "inc/classes/session.php";
\Biboletin\Session::start();
\Biboletin\Session::close();
header('Location: index.php');
