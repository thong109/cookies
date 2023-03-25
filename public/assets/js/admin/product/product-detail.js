$(document).ready(function () {
   ProductModules.Init();
   ProductModules.InitEvents();
});

var ProductModules = (function () {
   var obj = {
      'id': {
         'type': 'text',
         'attr': {
            'maxlength': 150
         }
      },
      'name': {
         'type': 'text',
         'attr': {
            'class': 'required',
            'maxlength': 150
         }
      },
      'description': {
         'type': 'CKEditor',
         'attr': {
            'class': 'required',
         }
      },
      'content': {
         'type': 'text',
         'attr': {
            'class': 'required',
         }
      },
      'price': {
         'type': 'text',
         'attr': {
            'class': 'required',
         }
      },
      'cost': {
         'type': 'text',
         'attr': {
            'class': 'required',
         }
      },
      'quantity': {
         'type': 'text',
         'attr': {
            'class': 'required',
         }
      },
      'sale': {
         'type': 'text',
         'attr': {
            'class': 'required',
         }
      },
      'image': {
         'type': 'text',
         'attr': {
            'maxlength': 100,
            'class': '',
         }
      },
      'tags': {
         'type': 'text',
         'attr': {
            'class': 'required',
            'maxlength': 100
         }
      },
      'status': {
         'type': 'select',
         'attr': {
            'class': 'for-select2'
         }
      },
      'brand': {
         'type': 'select',
         'attr': {
            'class': 'for-select2'
         }
      },
   };

   var Init = function () {
      try {
         if (mode === CONSTANTS.MODE.INSERT) {
            obj.image.attr.class = 'required';
         }
         Common.InitItem(obj);
         $('#name').focus();
      } catch (e) {
         console.log('Init: ' + e.message);
      }
   };

   var InitEvents = function () {
      try {
         // Click button save
         $('#btn-save').on('click', function () {
            SaveBlog();
         });
      } catch (e) {
         console.log('InitEvents: ' + e.message);
      }
   };

   var SaveBlog = function () {
      try {
         var validate = ValidateModule.Validate(obj);
         if (validate) {
            // submit form
            var data = Common.GetData(obj);
            if (parseInt(data.price) < parseInt(data.cost)) {
               Notification.Alert(MSG_NO.PRICE_NOT_COST, function () {
                  $("#price").focus();
               });
               return;
            }
            $("#form-product").ajaxSubmit({
               beforeSubmit: function (a, f, o) {
                  o.dataType = "json";
               },
               complete: function (XMLHttpRequest, textStatus) {
                  var res = XMLHttpRequest.responseJSON;
                  if (res) {
                     window.location = `${urls.editProduct}/${res.data.id}`;
                  } else {
                     Notification.Alert(MSG_NO.SERVER_ERROR, function () {
                        $("#name").focus();
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
      Init: Init,
      InitEvents: InitEvents
   };
})();
