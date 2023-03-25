$(document).ready(function () {
    AccountModules.InitEvents();
 });

 var AccountModules = (function () {

    var obj = {
       'id': {
          'type': 'text',
          'attr': {
             'maxlength': 150
          }
       },
       'customer_name': {
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
    };

    var InitEvents = function () {
       try {
          // Click button save
          $('#btn-save').on('click', function () {
             SaveAccount();
          });
       } catch (e) {
          console.log('InitEvents: ' + e.message);
       }
    };

    var SaveAccount = function () {
       try {
          var validate = ValidateModule.Validate(obj);
          if (validate) {
             // submit form
             $("#account-form").ajaxSubmit({
                beforeSubmit: function (a, f, o) {
                   o.dataType = "json";
                },
                success: function (XMLHttpRequest, textStatus) {
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
