 <div class="container">
     <h2 class="text-center mb-2">Có tất cả {{ count($productTags) }} sản phẩm</h2>
     <div class="block-element product-item-1 product-grid-view  default js-content-wrap">
         <div class="products row list-product-wrap js-content-main">
             @foreach ($productTags as $product)
                 <div
                     class="list-col-item list-4-item post-48252 product type-product status-publish has-post-thumbnail product_cat-samoyed product_cat-danh-muc-cun first instock shipping-taxable purchasable product-type-simple">
                     <div class="item-product item-product-grid">
                         <div class="product-thumb">
                             <!-- s7upf_woocommerce_thumbnail_loop have $size and $animation -->
                             <a href="san-pham/sam-sam-dang-yeu/index.html" class="product-thumb-link zoom-thumb">
                                 <img width="270" height="270"
                                     src="{{ URL::to('public/uploads/product/' . $product->product_image) }}"
                                     class="attachment-270x270 size-270x270 wp-post-image"
                                     sizes="(max-width: 270px) 100vw, 270px" style="width:270px;height:270px">
                             </a>
                             {{-- <div class="product-label"><span
                                    class="new">new</span></div> --}}
                             <div class="product-extra-link text-center">
                                 <ul class="list-product-extra-link list-inline-block">
                                     <li><a href="{{ URL::to('add-wishlist/' . $product->product_id) }}"
                                             style="display: flex;justify-content: center;align-items: center;"
                                             class="add_to_wishlist wishlist-link"
                                             data-product-title="{{ $product->product_content }}"><i
                                                 class="pegk pe-7s-like"></i><span>Yêu
                                                 thích</span></a></li>
                                     <li><a title="Xem nhanh"
                                             href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_slug) }}"
                                             style="display: flex;justify-content: center;align-items: center;"
                                             class="product-quick-view quickview-link "><i
                                                 class="pegk pe-7s-search"></i><span>Xem
                                                 nhanh</span></a></li>
                                     <li></li>
                                 </ul>
                                 <input type="hidden" name="productid_hidden" value="{{ $product->product_id }}">
                                 <form action="">
                                     @csrf
                                     <input type="hidden" value="{{ $product->product_id }}"
                                         class="cart_product_id_{{ $product->product_id }}">
                                     <input type="hidden" id="wistlist_productname{{ $product->product_id }}"
                                         value="{{ $product->product_name }}"
                                         class="cart_product_name_{{ $product->product_id }}">
                                     <input type="hidden" value="{{ $product->product_image }}"
                                         class="cart_product_image_{{ $product->product_id }}">
                                     <input type="hidden" value="{{ $product->product_quantity }}"
                                         class="cart_product_quantity_{{ $product->product_id }}">
                                     @php
                                         $product->product_sale_after = $product->product_price - ($product->product_price * $product->product_sale) / 100;
                                     @endphp
                                     <input type="hidden" id="wistlist_productprice{{ $product->product_id }}"
                                         value="{{ $product->product_sale_after }}"
                                         class="cart_product_sale_after_{{ $product->product_id }}">
                                     <input type="hidden" class="cart_product_qty_{{ $product->product_id }}"
                                         name="cart_product_quantity" min="1"
                                         oninput="validity.valid||(value='');" value="1">
                                     <input type="hidden" name="productid_hidden" value="{{ $product->product_id }}">
                                 </form>
                                 <?php if($product->product_quantity > 0){ ?>
                                 <a type="button" data-id_product="{{ $product->product_id }}" name="add-to-cart"
                                     class="add-to-cart button addcart-link shop-button bg-color"
                                     style="cursor: pointer"><span style="color: #fff">{{ __('AddToCart') }}</span></a>
                                 <?php } else { ?>
                                 <a type="button" href="javascript:;"
                                     class="button addcart-link shop-button bg-color add_to_cart_button s7upf_ajax_add_to_cart"
                                     style="text-decoration: none"><span>{{ __('SoldOff') }}</span></a>
                                 <?php } ?>
                             </div>
                         </div>
                         <div class="product-info">
                             <span class="title12 text-uppercase color font-bold">ID:
                                 {{ strtoupper($product->product_code) }}</span>
                             <h3 class="title18 text-uppercase product-title dosis-font font-bold">
                                 <a title="{{ $product->product_content }}" href="san-pham/sam-sam-dang-yeu/index.html"
                                     class="black">{{ $product->product_name }}</a>
                             </h3>
                             <div class="product-price simple">
                                 @if ($product->product_sale)
                                     <span
                                         class="woocommerce-Price-amount amount">{{ number_format($product->product_sale_after) }}<span
                                             class="woocommerce-Price-currencySymbol">&#8363;</span></span>
                                     <strike class="woocommerce-Price-amount amount"
                                         style="color: #de8ebe;
                                        font-weight: 700;
                                        font-size: 18px;">
                                         {{ number_format($product->product_price) }}
                                         <span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                     </strike>
                                 @else
                                     <span
                                         class="woocommerce-Price-amount amount">{{ number_format($product->product_price) }}<span
                                             class="woocommerce-Price-currencySymbol">&#8363;</span></span>
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </div>
 {{--  --}}
 {{--  --}}
 {{--  --}}
 <div class="container">
     <form action="{{ url('/update-cart') }}" method="POST">
         @csrf
         <table style="width: 100%">
             <tr class="chiakhoangcach">
                 <th class="checkout-image p-10">{{ __('Image') }}</th>
                 <th class="checkout-description p-10">{{ __('Name') }}</th>
                 <th class="checkout-quantity p-10">{{ __('Quantity') }}</th>
                 <th class="checkout-quantity p-10">{{ __('Price') }}</th>
                 <th class="checkout-quantity p-10">{{ __('Total') }}</th>
                 <th></th>
             </tr>
             @if (Session::get('cart') == true)
                 @php
                     $total = 0;
                 @endphp
                 @foreach (Session::get('cart') as $key => $cart)
                     @php
                         $subtotal = $cart['product_price'] * $cart['product_qty'];
                         $total += $subtotal;
                     @endphp
                     <tr>
                         <td class="checkout-image p-20">
                             <a href=""><img
                                     src="{{ asset('public/uploads/product/' . $cart['product_image']) }}"
                                     alt="{{ $cart['product_name'] }}" width="50px"></a>
                         </td>
                         <td class="checkout-description p-20">
                             <h3><a href="javascript:;" style="font-size: 20px">{{ $cart['product_name'] }}</a></h3>
                             {{-- <p>{{ $cart['product_desc'] }}</p> --}}
                         </td>
                         <td class="checkout-quantity p-20">
                             <input type="number" class="cart_quantity" min="1"
                                 oninput="validity.valid||(value='');" name="cart_qty[{{ $cart['session_id'] }}]"
                                 value="{{ $cart['product_qty'] }}" autocomplete="off" style="border:none">
                             <input type="hidden" value="" name="rowId_cart" class="form-control">
                         </td>
                         <td class="checkout-price p-20"><strong
                                 class="text-center">{{ number_format($cart['product_price']) }} VND</strong>
                         </td>
                         <td class="checkout-total p-20"><strong class="text-center">{{ number_format($subtotal) }}
                                 VND</strong></td>
                         <td>
                             <a class="cart_quantity_delete p-20"
                                 href="{{ url('/delete-sp/' . $cart['session_id']) }}"><i
                                     class="fa fa-times"></i></a>
                         </td>
                     </tr>
                 @endforeach
                 <tr>
                     <td style="padding-left:15px"><input type="submit" name="update-cart"
                             class="btn btn-default btn-sm" value="{{ __('Update') }}"></td>
                     <td style="list-style: none;padding-top:15px;padding-bottom:15px">
                         <li style="margin-left:15px">{{ __('Total') }} :<span>{{ number_format($total) }}
                                 VND</span>
                         </li>
                         @if (Session::get('coupon'))
                             <li>
                                 @foreach (Session::get('coupon') as $key => $cou)
                                     @if ($cou['coupon_condition'] == 1)
                                         {{ __('Coupon') }} : {{ $cou['coupon_number'] }} %
                                         <p>
                                             @php
                                                 $total_coupon = ($total * $cou['coupon_number']) / 100;
                                                 echo '<p>Tổng giảm :' . number_format($total_coupon) . ' VND</p>';
                                             @endphp
                                         </p>
                                         <p>{{ __('Total') }} : {{ number_format($total - $total_coupon) }} VND</p>
                                         <a href="{{ url('del-cou') }}"
                                             class="btn btn-primary">{{ __('DelCoupon') }}
                                         </a>
                                     @elseif ($cou['coupon_condition'] == 2)
                                         {{ __('Coupon') }} : {{ number_format($cou['coupon_number']) }} VND
                                         <p>
                                             @php
                                                 $total_coupon = $total - $cou['coupon_number'];
                                             @endphp
                                         </p>
                                         <p>{{ __('Total') }} : {{ number_format($total_coupon) }} VND</p>
                                         <a href="{{ url('del-cou') }}" class="btn btn-primary">
                                             {{ __('DelCoupon') }}
                                         </a>
                                     @endif
                                 @endforeach
                             </li>
                         @endif
                         {{-- <li>Thuế <span></span></li>
                <li>Phí vận chuyển <span>Free</span></li> --}}
                     </td>
                     <td style="padding-top: 15px;padding-bottom:15px" colspan="5">
                         @if (Session::get('customer_id'))
                             <a href="{{ url('checkout') }}" class="btn btn-primary pull-right"
                                 style="margin-right:15px;margin-left:15px">
                                 {{ __('Order') }}
                             </a>
                         @else
                             <a href="{{ url('login-checkout') }}" class="btn btn-primary pull-right"
                                 style="margin-right:15px;margin-left:15px">
                                 {{ __('Order') }}
                             </a>
                         @endif
                         <a href="{{ url('vn-payment') }}" class="btn btn-primary pull-right"
                             style="margin-right:15px;margin-left:15px">
                             {{ __('Vnpay Payment') }}
                         </a>
                         <a href="{{ url('/delete-all-cart/') }}"
                             class="btn btn-default pull-right margin-right-20">{{ __('Cancel') }}</a>
                     </td>
                 </tr>
             @else
                 <tr>
                     <td colspan="5">
                         <center>
                             @php
                                 echo 'Chưa có sản phẩm trong giỏ';
                             @endphp
                         </center>
                     </td>
                 </tr>
                 </tbody>
             @endif
         </table>
     </form>
     @if (!Session::get('coupon'))
         @if (Session::get('cart'))
             <tr>
                 <td colspan="5">
                     <form action="{{ url('/check-coupon') }}" method="POST">
                         @csrf
                         <div style="display: flex;margin-bottom:30px;margin-top:15px">
                             <input type="text" class="form-control" name="coupon"
                                 placeholder="{{ __('EnterDiscountCode') }}">
                             <input type="submit" name="form-control check_coupon"
                                 class="btn btn-default btn-sm check_coupon" value="{{ __('Coupon') }}">
                         </div>
                     </form>
                 </td>
             </tr>
         @endif
     @endif
     <div class="clearfix"></div>

 </div>
