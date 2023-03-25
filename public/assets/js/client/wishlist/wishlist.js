$(document).ready(function () {
    WishlistModules.InitEvents();
 });

 var WishlistModules = (function () {

    var InitEvents = function () {
       try {
          // Click button save
          fetchWishlist();

          $(document).on('click', '.product-remove-js', function () {
            DeleteWishlist($(this));
          });
       } catch (e) {
          console.log('InitEvents: ' + e.message);
       }
    };

    var NumberFormat = function(x){
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(x);
    }

    var fetchWishlist = function () {
       $.ajax({
          type: 'GET',
          url: urls.fetchWishlist,
          dataType: 'json',
          success: function (res) {
             var html = '';
             var wishlists = res.data;
             if (wishlists.length > 0) {
                for (let i = 0; i < wishlists.length; i++) {
                   html += ('<tr class="33">\
                     <td class="product-remove">\
                         <span class="remove remove_from_wishlist product-remove-js cursor" data-id="'+ wishlists[i].id +'" title="Remove this product">×</span>\
                     </td>\
                     <td class="product-thumbnail" style="width:100px;">\
                         <a class="wishlist-item-link" href="' + urls.productDetail + '/' + wishlists[i].wishlist.slug +'">\
                             <img class="img-responsive"\
                                 src="'+ wishlists[i].wishlist.image +'" alt="">\
                         </a>\
                     </td>\
                     <td class="product-name">\
                         <a class="wishlist-item-link" href="' + urls.productDetail + '/' + wishlists[i].wishlist.slug +'">'+ wishlists[i].wishlist.name +'</a>\
                     </td>\
                     <td class="wishlist-product-price product-price"><span class="money">'+ (wishlists[i].wishlist.sale > 0 ? NumberFormat(wishlists[i].wishlist.price - (wishlists[i].wishlist.price * wishlists[i].wishlist.sale / 100)) : NumberFormat(wishlists[i].wishlist.price)) +'</span>\
                     </td>\
                     <td class="product-stock-status">\
                         <span class="wishlist-in-stock">'+ (wishlists[i].wishlist.quantity > 0 ? `In stock` : `Out of stock`) +'</span>\
                     </td>\
                     <td class="product-add-to-cart">\
                         <a class="button wishlist-item-link btn" href="' + urls.productDetail + '/' + wishlists[i].wishlist.slug +'" rel="nofollow">View product</a>\
                     </td>\
                 </tr>');
                }
             } else {
                html += ('<tr>\
                   <td colspan="6">\
                       Your wishlist is currently empty!\
                   </td>\
               </tr>');
             }
             $('.wishlist-box').html(html);
          },
          error: function () {
             // Notification.Alert(MSG_NO.SERVER_ERROR);
          }
       });
    }

    var DeleteWishlist = function(x) {
        var id = x.attr('data-id');
        $.ajax({
            type: 'POST',
            url: urls.deleteWishlist,
            data: {id},
            dataType: 'json',
            success: function (res) {
                if (res.code === 200) {
                    fetchWishlist();
                }
            }
        });
    }
    return {
       InitEvents: InitEvents
    };
 })();
