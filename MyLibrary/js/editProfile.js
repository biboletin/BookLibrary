$(document).ready(function () {
    $.post('php/ajaxUsersResults.php', 'action=get_user_data')
        .done(function (result) {
            let data = JSON.parse(result);

            $('#first_name').val(data.response[0].first_name);
            $('#last_name').val(data.response[0].last_name);
            $('#username').val(data.response[0].username);
            $('#email').val(data.response[0].email);
        });

    $('#edit').click(function (e) {
        e.preventDefault();

        let firstName = $('#first_name').val();
        let lastName = $('#last_name').val();
        let username = $('#username').val();
        let email = $('#email').val();
        let password = $.trim($('#password').val());
        let confirmPassword = $.trim($('#confirm_password').val());
        let emailPattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (firstName === '') {
            alert('First name is empty!');
            return false;
        }
        if (lastName === '') {
            alert('Last name is empty!');
            return false;
        }
        if (username === '') {
            alert('User name is empty!');
            return false;
        }
        if (email === '') {
            alert('Email is empty!');
            return false;
        }
        if (emailPattern.test(email) === false) {
            alert('Invalid email address!');
            return false;
        }

        if (password !== confirmPassword) {
            alert('Password and confirm password fields do not match!');
            return false;
        }

        $.post('php/ajaxUsersResults.php', $('#edituser_form').serialize() + '&action=edit_profile')
            .done(function (response) {
                let data = JSON.parse(response);

                if (data.response === true) {
                    alert('Success!');
                    return true;
                }
            });
    });

    $('#back').click(function () {
        window.history.back();
    });

});