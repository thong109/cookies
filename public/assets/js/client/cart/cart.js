$(document).ready(function () {
    WishlistModules.InitEvents();
 });

 var WishlistModules = (function () {

    var InitEvents = function () {
       try {
          // Click button save
          fetchCart();

          $(document).on('click', '.product-remove-js', function () {
             DeleteWishlist($(this));
          });
          $(document).on('click', '.cart__remove', function () {
             DeleteCart($(this));
          });
          $(document).on('click', '.qtyplus1', function (e) {
             e.preventDefault();
             QtyPlus($(this));
          });
          $(document).on('click', ".qtyminus1", function (e) {
             e.preventDefault();
             QtyMinus($(this));
          });
          var timeout = null;
          $(document).on('keyup', '.cart-number', function () {
             clearTimeout(timeout);
             timeout = setTimeout(UpdateCart, 200);
          });
          $(document).on('click', '.check__coupon', function () {
            CheckCoupon();
          });
          $(document).on('click', '#delCoupon', function () {
            DelCoupon();
          });
       } catch (e) {
          console.log('InitEvents: ' + e.message);
       }
    };

    var QtyPlus = function (x) {
       var currentVal = parseInt(x.parent().find('input[name="updates[]"]').val());
       if (!isNaN(currentVal)) {
          x.parent().find('input[name="updates[]"]').val(currentVal + 1);
          UpdateCart();
          return;
       }
       x.parent().find('input[name="updates[]"]').val(1);
    }

    var QtyMinus = function (x) {
       var currentVal = parseInt(x.parent().find('input[name="updates[]"]').val());
       if (!isNaN(currentVal) && currentVal > 1) {
          x.parent().find('input[name="updates[]"]').val(currentVal - 1);
          UpdateCart();
          return;
       }
       x.parent().find('input[name="updates[]"]').val(1);
    }

    var UpdateCart = function () {
       var fieldsValues = [];
       $(".qty-box-set").each(function (index, field) {
          var fieldData = {};
          $(field).find("input[type=number]").each(function (index, input) {
             fieldData[input.placeholder] = input.value;
             return;
          });
          fieldsValues.push(fieldData);
       });
       var formData = new FormData();
       formData.append('qty', JSON.stringify(fieldsValues));
       $.ajax({
          type: 'POST',
          url: urls.updateCart,
          data: formData,
          contentType: false,
          processData: false,
          success: function (res) {
             if (res.code === 200) {
                fetchCart();
             }
          }
       });
    }

    var NumberFormat = function (x) {
       return new Intl.NumberFormat('vi-VN', {
          style: 'currency',
          currency: 'VND'
       }).format(x);
    }

    var fetchCart = function () {
       $.ajax({
          type: 'GET',
          url: urls.fetchCart,
          contentType: "application/json; charset=utf-8",
          dataType: "json",
          success: function (res) {
             var html = '';
             var cart = res.data;
             var coupon = res.coupon;
             var total = 0;
             if (cart.length) {
                if (cart.length > 0) {
                   for (let i = 0; i < cart.length; i++) {
                      var subtotal = cart[i].product_price * cart[i].product_qty;
                      total += subtotal;
                      html += ('<div class="cart__row border-bottom">\
                             <div class="grid--full cart__row--table-large">\
                                 <div\
                                     class="grid__item wide--three-tenths post-large--three-tenths large--three-tenths medium--grid__item">\
                                     <div class="grid cart_items">\
                                         <div class="grid__item wide--one-half post-large--one-half large--one-half medium--grid__item">\
                                             <a href="' + urls.productDetail + '/' + cart[i].product_slug + '" class="cart__image">\
                                                 <img src="' + cart[i].product_image + '" alt="' + cart[i].product_name + '">\
                                             </a>\
                                         </div>\
                                         <div class="grid__item wide--one-half post-large--one-half large--one-half medium--grid__item cart-title">\
                                             <a href="' + urls.productDetail + '/' + cart[i].product_slug + '" class="h5">' + cart[i].product_name + '</a>\
                                             <br>\
                                             <small>' + cart[i].product_brand + '</small>\
                                         </div>\
                                     </div>\
                                 </div>\
                                 <div class="grid__item wide--seven-tenths post-large--seven-tenths large--seven-tenths medium--grid__item">\
                                     <div class="grid--full cart__row--table-large">\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter">\
                                             <span class="h5 cart__large-labels">Price</span>\
                                             <span class="h5"><span class="money">' + NumberFormat(cart[i].product_price) + '</span></span>\
                                         </div>\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">\
                                             <span class="h5 cart__large-labels">Quantity</span>\
                                             <div class="qty-box-set">\
                                                 <input type="button" value="-" class="qtyminus1">\
                                                 <input type="number" class="quantity-selector cart-number" placeholder="' + cart[i].session_id + '" name="updates[]" id="qtyCart" value="' + cart[i].product_qty + '" min="0">\
                                                 <input type="button" value="+" class="qtyplus1">\
                                             </div>\
                                         </div>\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">\
                                             <span class="h5 cart__large-labels">Total</span>\
                                             <span class="h5">\
                                                 <span class="money">' + NumberFormat(cart[i].product_price * cart[i].product_qty) + '</span>\
                                             </span>\
                                         </div>\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">\
                                             <span class="h5 cart__large-labels">Remove</span>\
                                             <a class="cart__remove" delete-id="' + cart[i].session_id + '">\
                                                 <span><i class="fa fa-trash"></i></span>\
                                             </a>\
                                         </div>\
                                     </div>\
                                 </div>\
                             </div>\
                         </div>');
                   }
                   html = html + (' <div class="cart__row">\
                         <div class="grid shipping-section">\
                             <div class="grid__item wide--one-half post-large--one-half large--one-half flex">\
                                <input type="text" class="'+ (coupon[0] ? 'd-none' : '') +' form-control w-full coupon__text mb-0" name="coupon" id="coupon__text">\
                                <input type="button" class="'+ (coupon[0] ? 'd-none' : '') +' btn mb-0 none-border-radius check__coupon" name="coupon" value="Coupon">\
                             </div>\
                             <div class="grid__item text-right wide--one-half post-large--one-half large--one-half">\
                                 <div class="d-flex flex-column flex-end">\
                                 <p class="cart_total_price" style="margin:0;">\
                                     <span class="cart__subtotal-title h5">Subtotal :</span>\
                                     <span class="h5 cart__subtotal">' + NumberFormat(total) + '</span>\
                                 </p>\
                                 <p class="cart_total_price '+ (coupon[0] != null ? '' : 'd-none') +'" style="margin:0;">\
                                     <span class="cart__subtotal-title h5"><a class="cursor" id="delCoupon" title="Remove coupon">x</a> Coupon :</span>\
                                     <span class="h5 cart__subtotal">- ' + (coupon[0] ? NumberFormat(total- Coupon(total ,coupon[0].coupon_condition, coupon[0].coupon_number)) : '') + '</span>\
                                 </p>\
                                 <p class="cart_total_price" style="margin:0;">\
                                     <span class="cart__subtotal-title h5">Total :</span>\
                                     <span class="h5 cart__subtotal">' + (coupon[0] ? NumberFormat(Coupon(total ,coupon[0].coupon_condition, coupon[0].coupon_number)) : NumberFormat(total)) + '</span>\
                                 </p>\
                                 </div>\
                                 <div class="cart_btn">\
                                     <a class="btn" href="' + urls.home + '">Continue shopping</a>\
                                     <a class="btn" href="' + urls.checkout + '">Check out</a>\
                                 </div>\
                             </div>\
                         </div>\
                     </div>');
                } else {
                   html += ('<p class="border text-center p-3 d-grid">You haven"t placed any orders yet.</p>');
                }
             } else {
                if (Object.keys(cart).length > 0) {
                   Object.keys(cart).forEach(function (i) {
                      var subtotal = cart[i].product_price * cart[i].product_qty;
                      total += subtotal;
                      html += ('<div class="cart__row border-bottom">\
                             <div class="grid--full cart__row--table-large">\
                                 <div\
                                     class="grid__item wide--three-tenths post-large--three-tenths large--three-tenths medium--grid__item">\
                                     <div class="grid cart_items">\
                                         <div class="grid__item wide--one-half post-large--one-half large--one-half medium--grid__item">\
                                             <a href="' + urls.productDetail + '/' + cart[i].product_slug + '" class="cart__image">\
                                                 <img src="' + cart[i].product_image + '" alt="' + cart[i].product_name + '">\
                                             </a>\
                                         </div>\
                                         <div class="grid__item wide--one-half post-large--one-half large--one-half medium--grid__item cart-title">\
                                             <a href="' + urls.productDetail + '/' + cart[i].product_slug + '" class="h5">' + cart[i].product_name + '</a>\
                                             <br>\
                                             <small>' + cart[i].product_brand + '</small>\
                                         </div>\
                                     </div>\
                                 </div>\
                                 <div class="grid__item wide--seven-tenths post-large--seven-tenths large--seven-tenths medium--grid__item">\
                                     <div class="grid--full cart__row--table-large">\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter">\
                                             <span class="h5 cart__large-labels">Price</span>\
                                             <span class="h5"><span class="money">' + NumberFormat(cart[i].product_price) + '</span></span>\
                                         </div>\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">\
                                             <span class="h5 cart__large-labels">Quantity</span>\
                                             <div class="qty-box-set">\
                                                 <input type="button" value="-" class="qtyminus1">\
                                                 <input type="number" class="quantity-selector cart-number" placeholder="' + cart[i].session_id + '" name="updates[]" id="qtyCart" value="' + cart[i].product_qty + '" min="0">\
                                                 <input type="button" value="+" class="qtyplus1">\
                                             </div>\
                                         </div>\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">\
                                             <span class="h5 cart__large-labels">Total</span>\
                                             <span class="h5">\
                                                 <span class="money">' + NumberFormat(cart[i].product_price * cart[i].product_qty) + '</span>\
                                             </span>\
                                         </div>\
                                         <div class="grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-quarter small--one-quarter text-center">\
                                             <span class="h5 cart__large-labels">Remove</span>\
                                             <a class="cart__remove" delete-id="' + cart[i].session_id + '">\
                                                 <span><i class="fa fa-trash"></i></span>\
                                             </a>\
                                         </div>\
                                     </div>\
                                 </div>\
                             </div>\
                         </div>');
                   });
                   html = html + (' <div class="cart__row">\
                        <div class="grid shipping-section">\
                        <div class="grid__item wide--one-half post-large--one-half large--one-half flex">\
                            <input type="text" class="'+ (coupon[0] ? 'd-none' : '') +' form-control w-full coupon__text mb-0" name="coupon" id="coupon__text">\
                            <input type="button" class="'+ (coupon[0] ? 'd-none' : '') +' btn mb-0 none-border-radius check__coupon" name="coupon" value="Coupon">\
                        </div>\
                        <div class="grid__item text-right wide--one-half post-large--one-half large--one-half">\
                            <div class="d-flex flex-column flex-end">\
                            <p class="cart_total_price" style="margin:0;">\
                                <span class="cart__subtotal-title h5">Subtotal :</span>\
                                <span class="h5 cart__subtotal">' + NumberFormat(total) + '</span>\
                            </p>\
                            <p class="cart_total_price '+ (coupon[0] != null ? '' : 'd-none') +'" style="margin:0;">\
                                <span class="cart__subtotal-title h5"><a class="cursor" id="delCoupon" title="Remove coupon">x</a> Coupon :</span>\
                                <span class="h5 cart__subtotal">- ' + (coupon[0] ? NumberFormat(total- Coupon(total ,coupon[0].coupon_condition, coupon[0].coupon_number)) : '') + '</span>\
                            </p>\
                            <p class="cart_total_price" style="margin:0;">\
                                <span class="cart__subtotal-title h5">Total :</span>\
                                <span class="h5 cart__subtotal">' + (coupon[0] ? NumberFormat(Coupon(total ,coupon[0].coupon_condition, coupon[0].coupon_number)) : NumberFormat(total)) + '</span>\
                            </p>\
                            </div>\
                            <div class="cart_btn">\
                                <a class="btn" href="' + urls.home + '">Continue shopping</a>\
                                <a class="btn" href="' + urls.checkout + '">Check out</a>\
                            </div>\
                        </div>\
               </div>\
                     </div>');
                } else {
                   html += ('<p class="border text-center p-3 d-grid">You haven"t placed any orders yet.</p>');
                }
             }

             $('#allCart').html(html);
          },
          error: function () {
             // Notification.Alert(MSG_NO.SERVER_ERROR);
          }
       });
    }

    var DeleteWishlist = function (x) {
       var id = x.attr('data-id');
       $.ajax({
          type: 'POST',
          url: urls.deleteWishlist,
          data: {
             id
          },
          dataType: 'json',
          success: function (res) {
             if (res.code === 200) {
                fetchCart();
             }
          }
       });
    }

    var DeleteCart = function (x) {
       var sessionId = x.attr('delete-id');
       $.ajax({
          type: 'POST',
          url: urls.deleteCart,
          data: {
             sessionId
          },
          dataType: 'json',
          success: function (res) {
             if (res.code === 200) {
                fetchCart();
             }
          }
       });
    }

    var CheckCoupon = function (){
        var obj = {
            'coupon__text': {
               'type': 'text',
               'attr': {
                  'class': 'required',
                  'maxlength': 150
               }
            },
        }
        if( ValidateModule.Validate(obj)){
            coupon = $('.coupon__text').val();
            $.ajax({
                type: 'POST',
                url: urls.checkCoupon,
                data: {
                    coupon
                },
                dataType: 'json',
                success: function (res) {
                    if (res.code === 'S015') {
                        Notification.Alert(res.code, fetchCart());
                    }
                    if (res.code === 'E047') {
                        Notification.Alert(res.code, fetchCart());
                    }
                    if (res.code === 'E044') {
                        Notification.Alert(res.code, fetchCart());
                    }
                    if (res.code === 'E402') {
                        Notification.Alert(res.code, fetchCart());
                    }
                    if (res.code === 'E048') {
                        Notification.Alert(res.code, fetchCart());
                    }
                }
             });
        }
    }

    var Coupon = function (x, y, z){
        if(y === 1){
            total = x - (x * z / 100);
            return total;
        }
        if(y === 2){
            total = x - z;
            return total;
        }
    }

    var DelCoupon = function() {
        $.ajax({
            type: 'GET',
            url: urls.delCoupon,
            dataType: 'json',
            success: function (res) {
               if (res.code === 200) {
                    fetchCart();
               }
            }
            });
    }

    return {
       InitEvents: InitEvents
    };
 })();
