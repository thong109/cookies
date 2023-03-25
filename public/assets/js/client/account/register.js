$(document).ready(function () {
    RegisterModule.InitEvents();
 });

 var RegisterModule = (function () {
    var obj = {
        'customer_name': {
           'type': 'text',
           'attr': {
              'maxlength': 150,
              'class': 'required',
           }
        },
        'customer_email': {
           'type': 'text',
           'attr': {
              'class': 'required',
              'maxlength': 150
           }
        },
        'customer_phone': {
           'type': 'text',
           'attr': {
              'class': 'required',
              'maxlength': 150
           }
        },
        'customer_address': {
           'type': 'text',
           'attr': {
              'class': 'required',
           }
        },
        'customer_password': {
           'type': 'text',
           'attr': {
              'class': 'required',
           }
        },
     };

    var InitEvents = function () {
       try {
          // Click button save
          $('#btn-save').on('click', function () {
            CreateAccount();
         });
       } catch (e) {
          console.log('InitEvents: ' + e.message);
       }
    };

    var CreateAccount = function () {
        try {
            var validate = ValidateModule.Validate(obj);
            if (validate) {
               // submit form
               var data = Common.GetData(obj);
               if (data.customer_password.length < 8) {
                  Notification.Alert(MSG_NO.PASSWORD_WRONG_FORMAT, function () {
                     $("#customer_password").focus();
                  });
                  return;
               }
               //
               $("#form-account").ajaxSubmit({
                  beforeSubmit: function (a, f, o) {
                     o.dataType = "json";
                  },
                  success: function (res) {
                     if (res.code === 400) {
                        Notification.Alert(MSG_NO.EMAIL_HAD_USED);
                     }
                     if (res.code === 200) {
                        Notification.Alert(MSG_NO.CREATE_ACCOUNT_SUCCESS, function () {
                            window.location.href = urls.home;
                        });
                     }
                  },
               });
            } else {
               ValidateModule.FocusFirstError();
            }
         } catch (e) {
            console.log("SaveBlog: " + e.message);
         }
    };

    return {
       InitEvents: InitEvents
    };
 })();
