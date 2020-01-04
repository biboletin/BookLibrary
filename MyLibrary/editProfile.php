<?php
    include_once "partials/menu_header.php";
?>
<main role="main" class="container">
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="center_div">
                    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
                    <form id="edituser_form" method="post">
                        <label for="first_name" class="sr-only">First name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name"/>

                        <label for="last_name" class="sr-only">Last name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name"/>

                        <label for="username" class="sr-only">User name:</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>

                        <label for="email" class="sr-only">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email"/>

                        <label for="password" class="sr-only">New password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="New assword"/>

                        <label for="confirm_password" class="sr-only">Confirm password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm password"/>
                        <hr/>
                        <input type="button" id="edit" class="btn btn-primary" value="Edit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="js/editProfile.js"></script>
</body>
</html>
