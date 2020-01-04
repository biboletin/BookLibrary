$(document).ready(function () {
    $('#register').click(function () {
        window.location.href = 'register.php';
    });

    $('#login').click(function () {
        if(($('#username').val() === '') && ($('#password').val() === '')){
            alert('Please fill all fields!');
            return false;
        }
        if(($('#username').val() === '') || ($('#username').val().length < 3)){
            alert('Username is empty or less than 3 symbols!');
            return false;
        }
        if(($('#password').val() === '') || ($('#password').val().length < 6)){
            alert('Password is empty or less than 6 symbols!');
            return false;
        }
        $.post('php/ajaxResults.php', $('#login_form').serialize() + '&action=login')
            .done(function (response) {
                let data = JSON.parse(response);
                if(data.response !== true){
                    alert('Wrong username or password!');
                    return false;
                }
                window.location.href = 'home.php';
            });
        return true;
    });
});