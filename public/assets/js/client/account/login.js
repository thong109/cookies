$(document).ready(function () {
    LoginModule.InitEvents();
});

var LoginModule = (function () {
    var obj = {
        'customer_email': {
            'type': 'text',
            'attr': {
                'maxlength': 150,
                'class': 'required',
            }
        },
        'customer_password': {
            'type': 'text',
            'attr': {
                'class': 'required',
                'maxlength': 150
            }
        },
    };
    var email = {
        'email': {
            'type': 'text',
            'attr': {
                'maxlength': 150,
                'class': 'required',
            }
        },
    };

    var InitEvents = function () {
        try {
            // Click button save
            $(document).on('click', '#btn-login', function () {
                Login();
            });
            $('#showRecoverPasswordForm').on('click', function () {
                showRecoverPasswordForm();
                return false;
            });
            $('#hideRecoverPasswordForm').on('click', function () {
                hideRecoverPasswordForm();
                return false;
            });
            $('#btn-forget-pasword').on('click', function () {
                Forget();
            });
        } catch (e) {
            console.log('InitEvents: ' + e.message);
        }
    };

    var Login = function () {
        try {
            // Check for errors of input data
            if (ValidateModule.Validate(obj)) {
                var data = Common.GetData(obj);
                // Submit to the server
                $.ajax({
                    type: 'POST',
                    url: loginUrl.loginCustomer,
                    dataType: 'json',
                    data: data,
                    success: function (res) {
                        if (res.code === 200) {
                            window.history.back();
                        }
                        if (res.code === 400) {
                            Notification.Alert(MSG_NO.USERNAME_OR_PASSWORD_NOT_INCORRECT);
                        }
                    }
                });
            }
            else {
                ValidateModule.FocusFirstError();
            }
        }
        catch (e) {
            console.log('SubmitLogin: ' + e.message);
        }
    };

    var Forget = function () {
        try {
            // Check for errors of input data
            if (ValidateModule.Validate(email)) {
                var data = Common.GetData(email);
                // Submit to the server
                $.ajax({
                    type: 'POST',
                    url: urls.processEmail,
                    dataType: 'json',
                    data: data,
                    success: function (res) {
                        if (res.code === 200) {
                            $('#forgot-password-form')[0].reset();
                            Notification.Alert(MSG_NO.SEND_MAIL_NOTIFICATION_SUCCESS);
                        }
                        if (res.code === 400) {
                            Notification.Alert(MSG_NO.USERNAME_NOT_INCORRECT);
                        }
                    }
                });
            }
            else {
                ValidateModule.FocusFirstError();
            }
        }
        catch (e) {
            console.log('SubmitLogin: ' + e.message);
        }
    };

    var showRecoverPasswordForm = function () {
        document.getElementById('RecoverPasswordForm').style.display = 'block';
        document.getElementById('CustomerLoginForm').style.display = 'none';
    }

    var hideRecoverPasswordForm = function () {
        document.getElementById('RecoverPasswordForm').style.display = 'none';
        document.getElementById('CustomerLoginForm').style.display = 'block';
    }
    if (window.location.hash == '#recover') {
        showRecoverPasswordForm()
    }

    return {
        InitEvents: InitEvents
    };
})();
