<?php
include_once "inc/classes/session.php";

\Biboletin\Session::start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Library</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/index.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="center_div">
            <h1 class="h3 mb-3 font-weight-normal">My Library</h1>
            <form id="login_form" method="post">
                <label for="username" class="sr-only">User name:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>

                <label for="username" class="sr-only">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                <hr/>
                <input type="button" id="login" class="btn btn-primary" value="Login"/>
                <input type="button" id="register" class="btn btn-link" value="Register"/>
            </form>
        </div>
    </div>
</div>

<script src="js/index.js"></script>
</body>
</html>