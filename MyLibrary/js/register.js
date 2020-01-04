$(document).ready(function () {
    $('#register').click(function (e) {
        e.preventDefault();

        let firstName = $('#first_name').val();
        let lastName = $('#last_name').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let confirmPassword = $('#confirm_password').val();
        let emailPattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(firstName === ''){
            alert('First name is empty!');
            return false;
        }
        if(lastName === ''){
            alert('Last name is empty!');
            return false;
        }
        if(username === ''){
            alert('User name is empty!');
            return false;
        }
        if(email === ''){
            alert('Email is empty!');
            return false;
        }
        if(emailPattern.test(email) === false){
            alert('Invalid email address!');
            return false;
        }
        if(password === ''){
            alert('Password is empty');
            return false;
        }

        if(password !== confirmPassword){
            alert('Password and confirm password fields do not match!');
            return false;
        }
        $.post('php/ajaxUsersResults.php', $('#register_form').serialize() + '&action=register')
            .done(function (response) {
                let data = JSON.parse(response);

                if(data.response === false){
                    alert('Unexpected error with adding user(Existing user)!');
                    return false;
                }
                if(data.response === true){
                    window.location.href = 'home.php';
                }
        });
    });

    $('#back').click(function () {
        window.history.back();
    });

});