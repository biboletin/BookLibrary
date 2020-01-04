$(document).ready(function () {
    $('#register').click(function () {
        let firstName = $('#first_name').val();
        let lastName = $('#last_name').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let confirmPassword = $('#confirm_password').val();
/*
        if(firstName === ''){
            alert('');
            return false;
        }
        if(){
            alert('');
            return false;
        }
        if(){
            alert('');
            return false;
        }
        if(){
            alert('');
            return false;
        }
        if(){
            alert('');
            return false;
        }
        if(){
            alert('');
            return false;
        }
        if(){
            alert('');
            return false;
        }
*/
        if(password !== confirmPassword){
            alert('Password and confirm password fields do not match!');
            return false;
        }
        $.post('php/ajaxResults.php', $('#register_form').serialize() + '&action=register')
            .done(function (response) {
                // let data = JSON.parse(response);
                console.log(JSON.parse(response));
                // if(data.response === true){
                //     window.location.href = 'home.php';
                // }
        });
    });

    $('#back').click(function () {
        window.history.back();
    });

    $('#back').click(function () {
        window.history.back();
    });

});