<?php
include_once "inc/classes/session.php";
include_once "inc/classes/token.php";

\Biboletin\Session::start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
            <h1 class="h3 mb-3 font-weight-normal">Register</h1>
            <form id="register_form" method="post">
                <label for="first_name" class="sr-only">First name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name"/>

                <label for="last_name" class="sr-only">Last name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name"/>

                <label for="username" class="sr-only">User name:</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>

                <label for="email" class="sr-only">Email:</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>

                <label for="password" class="sr-only">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>

                <label for="confirm_password" class="sr-only">Confirm password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password"/>

                <hr/>
                <input type="button" id="register" class="btn btn-primary" value="Register"/>
                <input type="button" id="back" class="btn btn-link" value="Back"/>
            </form>
        </div>
    </div>
</div>

<script src="js/register.js"></script>
</body>
</html>