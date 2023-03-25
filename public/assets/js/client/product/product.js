$(document).ready(function () {
   ProductModules.InitEvents();
});

var ProductModules = (function () {

   var InitEvents = function () {
      try {
         fetchCart();
         // Click button save
         $(document).on('click', '.showWishlist', function () {
            AddWishlist($(this));
         });
         $(document).on('click', '.AddToCart', function () {
            AddToCart($(this));
         });
         $(document).on('click', '.btn-remove', function () {
            DeleteCart($(this));
         });
         $(document).on('click', '.quick-view-text', function () {
            QuickView($(this));
         });
      } catch (e) {
         console.log('InitEvents: ' + e.message);
      }
   };

   var AddToCart = function (btn) {
      var id = btn.data('id_product');
      var cart_product_id = $('.cart_product_id_' + id).val();
      var cart_product_name = $('.cart_product_name_' + id).val();
      var cart_product_image = $('.cart_product_image_' + id).val();
      var cart_product_quantity = $('.cart_product_quantity_' + id).val();
      var cart_product_price = $('.cart_product_price_' + id).val();
      var cart_product_qty = $('.cart_product_qty_' + id).val();
      var cart_product_brand = $('.cart_product_brand_' + id).val();
      var cart_product_slug = $('.cart_product_slug_' + id).val();
      if (parseInt(cart_product_qty) < 0) {
         Notification.Alert(MSG_NO.QUANTITY_ZERO);
         return;
      }
      if (parseInt(cart_product_qty) > parseInt(cart_product_quantity)) {
         Swal.fire({
            icon: 'error',
            text: 'Bạn không thể đặt quá ' + cart_product_quantity + ' sản phẩm',
         })
         return;
      }
      $.ajax({
         url: clientUrl.addToCart,
         type: 'POST',
         dataType: 'json',
         data: {
            cart_product_id: cart_product_id,
            cart_product_name: cart_product_name,
            cart_product_quantity: cart_product_quantity,
            cart_product_image: cart_product_image,
            cart_product_price: cart_product_price,
            cart_product_qty: cart_product_qty,
            cart_product_brand: cart_product_brand,
            cart_product_slug: cart_product_slug
         },
         success: function (res) {
            if (res.code === 200) {
               Swal.fire({
                  showCloseButton: true,
                  showConfirmButton: false,
                  html: '<div class="ajax-left">' +
                     '<img class="ajax-product-image" alt="modal window" src="' + cart_product_image + '">' +
                     '</div>' +
                     '<div class="ajax-right">' +
                     '<h3 class="ajax-product-title">' + cart_product_name + '</h3>' +
                     '<span class="ajax_price">' + NumberFormat(cart_product_price) + '</span>' +
                     '<div class="success-message added-to-cart p-0">' +
                     '<a href="' + clientUrl.cart + '" class="btn csslai"><i class="fa fa-shopping-cart"></i>View Cart</a>' +
                     '</div>'
               });
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

   var AddWishlist = function (x) {
      try {
         x.find('.default-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'none');
         x.find('.loadding-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'block');
         var id = x.find('.product-id').val();
         $.ajax({
            url: clientUrl.addWishlist,
            type: 'POST',
            data: {
               id: id,
            },
            success: function (res) {
               if (res.code === 200) {
                  x.find('.loadding-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'none');
                  x.find('.added-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'block');
               }
               if (res.code === 402) {
                  x.find('.loadding-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'none');
                  x.find('.added-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'block');
                  Notification.Alert(MSG_NO.YOU_MUST_LOGIN, function () {
                     window.location.href = clientUrl.loginCheckout;
                  });
               }
               if (res.code === 400) {
                  x.find('.loadding-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'none');
                  x.find('.added-wishbutton-monkey-love-valentines-gift-pail-basket').css('display', 'block');
                  return;
               }
            }
         });
      } catch (e) {
         console.log("AddWishlist: " + e.message);
      }
   };

   var fetchCart = function () {
      $.ajax({
         type: 'GET',
         url: clientUrl.fetchCart,
         contentType: "application/json; charset=utf-8",
         dataType: "json",
         success: function (res) {
            var html = '';
            var count = '';
            var cart = res.data;
            var total = 0;
            if (cart.length) {
               if (cart.length > 0) {
                  count += (cart.length);
                  html += ('<div class="has-items" style="display: block;">\
                  <ul class="mini-products-list">');
                  for (let i = 0; i < cart.length; i++) {
                     var subtotal = cart[i].product_price * cart[i].product_qty;
                     total += subtotal;
                     html = html + ('<li class="item">\
                     <a href="' + clientUrl.productDetail + '/' + cart[i].product_slug + '" title="' + cart[i].product_name + '" class="product-image">\
                        <img src="' + cart[i].product_image + '" alt="' + cart[i].product_name + '">\
                        </a>\
                        <div class="product-details"><a href="javascript:void(0)" class="btn-remove" delete-id="' + cart[i].session_id + '">\
                        <span class="icon-close"></span></a><p class="product-name">\
                        <a href="' + clientUrl.productDetail + '/' + cart[i].product_slug + '">' + cart[i].product_name + '</a>\
                        </p><div class="cart-collateral">' + cart[i].product_qty + ' x <span class="price"><span class="money">' + NumberFormat(cart[i].product_price) + '</span></span></div></div>\
                        </li>');
                  }
                  html = html + ('</ul>\
                  </div>\
                  <div class="summary">\
                  <p class="total">\
                    <span class="label">Cart total:</span>\
                    <span class="price"><span class="money">' + NumberFormat(total) + '</span></span>\
                  </p>\
                </div>\
                <div class="actions">\
                  <a class="btn" href="' + clientUrl.checkout + '"><i class="icon-check"></i>Check Out</a>\
                  <a href="' + clientUrl.cart + '" class="btn text-cart"><i class="icon-basket"></i>View Cart</a>\
                </div>');
               } else {
                  count += ('0');
                  html += ('<div class="no-items" style="display: block;">\
                  <p>Your cart is currently empty!</p>\
                  <p class="text-continue"><a class="btn" href="javascript:void(0)">Continue shopping</a></p>\
                </div>');
               }
            } else {
               if (Object.keys(cart).length > 0) {
                  count += (Object.keys(cart).length);
                  html += ('<div class="has-items" style="display: block;">\
                  <ul class="mini-products-list">');
                  Object.keys(cart).forEach(function (i) {
                     var subtotal = cart[i].product_price * cart[i].product_qty;
                     total += subtotal;
                     html += ('<li class="item">\
                     <a href="' + clientUrl.productDetail + '/' + cart[i].product_slug + '" title="' + cart[i].product_name + '" class="product-image">\
                        <img src="' + cart[i].product_image + '" alt="' + cart[i].product_name + '">\
                        </a>\
                        <div class="product-details"><a href="javascript:void(0)" title="Remove This Item" class="btn-remove" delete-id="' + cart[i].session_id + '">\
                        <span class="icon-close"></span></a><p class="product-name">\
                        <a href="' + clientUrl.productDetail + '/' + cart[i].product_slug + '">' + cart[i].product_name + '</a>\
                        </p><div class="cart-collateral">' + cart[i].product_qty + ' x <span class="price"><span class="money">' + NumberFormat(cart[i].product_price) + '</span></span></div></div>\
                        </li>');
                  });
                  html = html + ('</ul>\
                  </div>\
                  <div class="summary">\
                  <p class="total">\
                    <span class="label">Cart total:</span>\
                    <span class="price"><span class="money">' + NumberFormat(total) + '</span></span>\
                  </p>\
                </div>\
                <div class="actions">\
                  <a class="btn" href="' + clientUrl.checkout + '"><i class="icon-check"></i>Check Out</a>\
                  <a href="' + clientUrl.cart + '" class="btn text-cart"><i class="icon-basket"></i>View Cart</a>\
                </div>');
               } else {
                  count += ('0');
                  html += ('<div class="no-items" style="display: block;">\
                  <p>Your cart is currently empty!</p>\
                  <p class="text-continue"><a class="btn" href="javascript:void(0)">Continue shopping</a></p>\
                </div>');
               }
            }

            $('#slidedown-cart').html(html);
            $('#cartCount').html(count);
         },
         error: function () {
            // Notification.Alert(MSG_NO.SERVER_ERROR);
         }
      });
   }

   var DeleteCart = function (x) {
      var sessionId = x.attr('delete-id');
      $.ajax({
         type: 'POST',
         url: clientUrl.deleteCart,
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

   var QuickView = function (btn) {
      var id = btn.attr('view-id');
      var product_id = $('.cart_product_id_' + id).val();
      $.ajax({
         url: clientUrl.quickView,
         type: 'POST',
         dataType: 'json',
         data: {
            product_id: product_id
         },
         success: function (res) {
            if (res.code === 200) {
               Swal.fire({
                  showCloseButton: true,
                  showConfirmButton: false,
                  showCancelButton: false,
                  html: '<div class="overlay"></div><div class="content clearfix"><div class="product-img images">' +
                     '<input type="hidden" value="1" class= "cart_product_qty_' + res.product.id + '" >' +
                     '<input type="hidden" value="' + res.product.id + '" class="cart_product_id_' + res.product.id + '">' +
                     '<input type="hidden" value="' + res.product.name + '" class="cart_product_name_' + res.product.id + '">' +
                     '<input type="hidden" value="' + res.product.image + '" class="cart_product_image_' + res.product.id + '">' +
                     '<input type="hidden" value="' + res.product.quantity + '" class="cart_product_quantity_' + res.product.id + '">' +
                     '<input type="hidden" value="' + (res.product.price - (res.product.price * res.product.sale /100)) + '" class="cart_product_price_' + res.product.id + '">' +
                     '<input type="hidden" value="' + res.product.nameBrand + '" class="cart_product_brand_' + res.product.id + '">' +
                     '<input type="hidden" value="' + res.product.slug + '" class="cart_product_slug_' + res.product.id + '">' +
                     '<div class="quickview-featured-image product-photo-container"><a href="/products/with-our-deepest-sympathy-gourmet-gift-board">' +
                     '<img src="' + res.product.image + '" title="Cat" s tongue cookie"><div class="abc"></div></a></div></div><div class="product-shop summary"><div class="product-item product-detail-section" id="product-11358364612"><h2 class="product-title-quickview"><a href="' + clientUrl.productDetail + '/' + res.product.slug + '">' +
                     '' + res.product.name + '</a></h2><div class="prices product_price product-quickview"><span>Price :</span><div class="flex"><span class="price-quickview price h2" id="QProductPrice"><span class="money-quickview">' + (res.product.sale > 0 ? NumberFormat(res.product.price - (res.product.price * res.product.sale / 100)) : '') + '</span></span><span class="compare-price" id="QComparePrice"><span class="money-del">' + NumberFormat(res.product.price) + '</span></span></div></div><div class="product-infor"><p class="product-inventory-quickview" style="opacity: 1;"><span>Availability : </span><span>' + (res.product.quantity > 0 ? 'Many In Stock' : 'Out Of Stock') + '</span></p></div><div class="details clearfix"><div class="selector-wrapper">' +
                     '<div class="qty-section-quickview quantity-box"><span>Quantity : </span><input type="number" name="quantity" id="Qty" value="1" class="quantity"><div class="actions"><button type="button" class="add-to-cart-btn btn AddToCart" data-id_product="' + res.product.id + '">Add to Cart</button></div></div></div></div></div></div>'
               });
            }
         }
      });
   }
   return {
      InitEvents: InitEvents
   };
})();
