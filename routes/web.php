<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryMxhController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DanhmucController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MailAdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VnpayController;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::resource('/', function () {
//     return view('layout');
// });
// Route::get('/trang-chu', function () {
//     return view('layout');
// });
//Frontend
Route::resource('/home', HomeController::class);
Route::get('/home', [HomeController::class, 'index'])->name('Home');
Route::resource('/', HomeController::class);
//Search
Route::get('/timkiem', [HomeController::class, 'timkiem']);
Route::get('/products', [HomeController::class, 'search'])->name('Products');
Route::post('/autocomplete-ajax', [HomeController::class, 'autocomplete_ajax']);

//Danh muc
Route::get('/detail-product/{slug}', [ProductController::class, 'productDetail'])->name('ProductDetail');
Route::get('/chi-tiet-course/{course_id}', [CourseController::class, 'details_course']);
//Register
Route::get('/register', [RegisterController::class, 'register']);
Route::get('/activity', [HomeController::class, 'activity']);
Route::get('/sponsor', [HomeController::class, 'sponsor']);
Route::get('/course', [HomeController::class, 'course']);
//Mail
Route::get('/mail', [RegisterController::class, 'mail']);
//send mail
Route::get('/send-mail', [MailAdminController::class, 'send_mail']);
//
Route::post('/quickview', [ProductController::class, 'quickview'])->name('QuickView');
//Comment
Route::post('/load-comment', [ProductController::class, 'load_comment']);
Route::post('/send-comment', [ProductController::class, 'send_comment'])->name('SendComment');
Route::get('/list-comment', [ProductController::class, 'list_comment']);
Route::get('/delete-comment/{comment_id}', [ProductController::class, 'delete_comment']);
Route::post('/reply-comment', [ProductController::class, 'reply_comment']);
Route::post('/allow-comment', [ProductController::class, 'allow_comment']);
//Rating
Route::post('/insert-rating', [ProductController::class, 'insert_rating']);
// Route::get('/language/{language}', [LanguageController::class, 'language.dashboard']);
//Backend
Route::resource('/admin', AdminController::class);
Route::get('/dashboard', [AdminController::class, 'showdashboard']);
Route::get('/thongke', [AdminController::class, 'thongke'])->name('Dashboard');
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/language/{language}', [LanguageController::class, 'language']);
Route::post('/postcontact', [RegisterController::class, 'postcontact']);

//Category Product
Route::get('/brand', [BrandController::class, 'brand'])->name('Brand');
Route::get('/brand/create', [BrandController::class, 'createBrand'])->name('CreateBrand');
Route::post('/brand/create', [BrandController::class, 'insertBrand'])->name('InsertBrand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand'])->name('EditBrand');
Route::post('/brand/edit/{id}', [BrandController::class, 'updateBrand'])->name('UpdateBrand');
Route::get('/brand/delete', [BrandController::class, 'deleteBrand'])->name('DeleteBrand');
Route::get('/brand/change-status', [BrandController::class, 'changeStatus'])->name('ChangeStatusOfBrand');
//danhmuc
Route::get('category', [DanhmucController::class, 'category'])->name('Category');
Route::get('category/create', [DanhmucController::class, 'createCategory'])->name('CreateCategory');
Route::post('category/create', [DanhmucController::class, 'insertCategory'])->name('InsertCategory');
Route::get('category/edit/{id}', [DanhmucController::class, 'editCategory'])->name('EditCategory');
Route::post('category/edit/{id}', [DanhmucController::class, 'updateCategory'])->name('UpdateCategory');
Route::get('category/delete', [DanhmucController::class, 'deleteCategory'])->name('DeleteCategory');
Route::get('category/change-status', [DanhmucController::class, 'changeStatus'])->name('ChangeStatusOfCategory');
//Product
Route::get('/product', [ProductController::class, 'product'])->name('Product');
Route::get('/product/create', [ProductController::class, 'createProduct'])->name('CreateProduct');
Route::post('/product/create', [ProductController::class, 'insertProduct'])->name('InsertProduct');
Route::get('/product/edit/{id}', [ProductController::class, 'editProduct'])->name('EditProduct');
Route::post('/product/edit/{id}', [ProductController::class, 'updateProduct'])->name('UpdateProduct');
Route::get('/product/delete/', [ProductController::class, 'deleteProduct'])->name('DeleteProduct');
Route::get('/product/change-status', [ProductController::class, 'changeStatus'])->name('ChangeStatusOfProduct');
//Export
Route::post('/export-csv', [CategoryProduct::class, 'export_csv']);
Route::post('/export-product', [ProductController::class, 'export_product']);
//Import
Route::post('/import-csv', [CategoryProduct::class, 'import_csv']);
Route::post('/import-product', [ProductController::class, 'import_product']);
Route::post('/import-word', [ProductController::class, 'import_word']);

//Cart
// Route::post('/save-cart', [CartController::class, 'save_cart']);
// Route::get('/show-cart', [CartController::class, 'show_cart']);
// Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);
// Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('UpdateCart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('AddToCart');
Route::get('/cart', [CartController::class, 'cart'])->name('Cart');
Route::get('/fetch-cart', [CartController::class, 'fetchCart'])->name('FetchCart');
Route::post('/cart/delete', [CartController::class, 'deleteCart'])->name('DeleteCart');
Route::get('/delete-all-cart', [CartController::class, 'delete_all_cart']);
//Coupon
Route::post('/check-coupon', [CartController::class, 'checkCoupon'])->name('CheckCoupon');
Route::get('/delete-coupon', [CartController::class, 'delCoupon'])->name('DelCoupon');
//Delivery
Route::get('/delivery', [DeliveryController::class, 'delivery'])->name('Delivery');
Route::get('/select-delivery', [DeliveryController::class, 'fetchDelivery'])->name('FetchDelivery');
Route::post('/insert-delivery', [DeliveryController::class, 'insertDelivery'])->name('InsertDelivery');
Route::get('/select-feeship', [DeliveryController::class, 'fetchFeeship'])->name('FetchFeeship');
Route::post('/update-delivery', [DeliveryController::class, 'updateDelivery'])->name('UpdateDelivery');
//post
// Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/caculate-fee', [CheckoutController::class, 'caculateFee'])->name('CaculateFee');
Route::get('/fetch-total', [CheckoutController::class, 'fetchTotal'])->name('FetchTotal');
Route::get('/del-fee', [CheckoutController::class, 'del_fee']);
//Coupon Admin
Route::get('/coupon', [CouponController::class, 'coupon'])->name('Coupon');
Route::get('/coupon/create', [CouponController::class, 'createCoupon'])->name('CreateCoupon');
Route::post('/coupon/create', [CouponController::class, 'insertCoupon'])->name('InsertCoupon');
Route::get('/coupon/delete/', [CouponController::class, 'deleteCoupon'])->name('DeleteCoupon');
Route::get('/coupon/change-status', [CouponController::class, 'changeStatus'])->name('ChangeStatusOfCoupon');
//Checkout
Route::get('/account/login', [CheckoutController::class, 'login'])->name('Login');
Route::post('/account/login', [CheckoutController::class, 'loginCustomer'])->name('LoginCustomer');
Route::get('/account/register', [CheckoutController::class, 'register'])->name('Register');
Route::post('/create/account', [CheckoutController::class, 'createAccount'])->name('CreateAccount');
Route::get('/customer/create', [AdminController::class, 'createCustomer'])->name('CreateCustomer');
Route::post('/save-customer', [AdminController::class, 'insertCustomer'])->name('InsertCustomer');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('Checkout');
Route::post('/save-checkout', [CheckoutController::class, 'save_checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::get('/account/logout', [CheckoutController::class, 'logout'])->name('Logout');
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order'])->name('ConfirmOrder');
Route::get('/pay', [CheckoutController::class, 'pay'])->name('Pay');
//Order
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty'])->name('UpdateQty');
//Order Admin
Route::get('/order', [OrderController::class, 'manageOrder'])->name('ManageOrder');
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::get('/delete-order/{order_code}', [OrderController::class, 'delete_order']);
Route::get('/profile-admin/{admin_id}', [AdminController::class, 'profileAdmin']);
Route::post('/edit-admin-profile/{admin_id}', [AdminController::class, 'editAdmin']);
//Print_Order
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);

//Banner
Route::get('/add-banner', [BannerController::class, 'add_banner']);
Route::get('/edit-banner/{banner_id}', [BannerController::class, 'edit_banner']);
Route::get('/delete-banner/{banner_id}', [BannerController::class, 'delete_banner']);
Route::get('/all-banner', [BannerController::class, 'all_banner']);
Route::get('/unactive-banner/{banner_id}', [BannerController::class, 'unactive_banner']);
Route::get('/active-banner/{banner_id}', [BannerController::class, 'active_banner']);
Route::post('/save-banner', [BannerController::class, 'save_banner']);
Route::post('/update-banner/{banner_id}', [BannerController::class, 'update_banner']);
//Slider
Route::get('/add-slider', [SliderController::class, 'add_slider']);
Route::get('/edit-slider/{slider_id}', [SliderController::class, 'edit_slider']);
Route::get('/delete-slider/{slider_id}', [SliderController::class, 'delete_slider']);
Route::get('/all-slider', [SliderController::class, 'all_slider']);
Route::get('/unactive-slider/{slider_id}', [SliderController::class, 'unactive_slider']);
Route::get('/active-slider/{slider_id}', [SliderController::class, 'active_slider']);
Route::post('/save-slider', [SliderController::class, 'save_slider']);
Route::post('/update-slider/{slider_id}', [SliderController::class, 'update_slider']);
//Sponsor
Route::get('/add-sponsor', [SponsorController::class, 'add_sponsor']);
Route::get('/edit-sponsor/{sponsor_id}', [SponsorController::class, 'edit_sponsor']);
Route::get('/delete-sponsor/{sponsor_id}', [SponsorController::class, 'delete_sponsor']);
Route::get('/all-sponsor', [SponsorController::class, 'all_sponsor']);
Route::get('/unactive-sponsor/{sponsor_id}', [SponsorController::class, 'unactive_sponsor']);
Route::get('/active-sponsor/{sponsor_id}', [SponsorController::class, 'active_sponsor']);
Route::post('/save-sponsor', [SponsorController::class, 'save_sponsor']);
Route::post('/update-sponsor/{sponsor_id}', [SponsorController::class, 'update_sponsor']);
//Course
Route::get('/add-course', [CourseController::class, 'add_course']);
Route::get('/edit-course/{course_id}', [CourseController::class, 'edit_course']);
Route::get('/delete-course/{course_id}', [CourseController::class, 'delete_course']);
Route::get('/all-course', [CourseController::class, 'all_course']);
Route::get('/unactive-course/{course_id}', [CourseController::class, 'unactive_course']);
Route::get('/active-course/{course_id}', [CourseController::class, 'active_course']);
Route::post('/save-course', [CourseController::class, 'save_course']);
Route::post('/update-course/{course_id}', [CourseController::class, 'update_course']);
//Activity
Route::get('/add-activity', [ActivityController::class, 'add_activity']);
Route::get('/edit-activity/{activity_id}', [ActivityController::class, 'edit_activity']);
Route::get('/delete-activity/{activity_id}', [ActivityController::class, 'delete_activity']);
Route::get('/all-activity', [ActivityController::class, 'all_activity']);
Route::get('/unactive-activity/{activity_id}', [ActivityController::class, 'unactive_activity']);
Route::get('/active-activity/{activity_id}', [ActivityController::class, 'active_activity']);
Route::post('/save-activity', [ActivityController::class, 'save_activity']);
Route::post('/update-activity/{activity_id}', [ActivityController::class, 'update_activity']);
//introduce
//Login facebook
Route::get('/login-facebook', [AdminController::class, 'login_facebook']);
Route::get('/admin/callback', [AdminController::class, 'callback_facebook']);
//add gallery
Route::get('/add-gallery/{product_id}', [GalleryController::class, 'add_gallery']);
Route::post('/select-gallery', [GalleryController::class, 'select_gallery']);
Route::post('/insert-gallery/{pro_id}', [GalleryController::class, 'insert_gallery']);
Route::post('/update-gallery', [GalleryController::class, 'update_gallery']);
Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);
Route::post('/update-gallery-image', [GalleryController::class, 'update_gallery_image']);
//THong ke
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date'])->name('FilterByDate');
Route::post('/day-orders', [AdminController::class, 'day_orders'])->name('DayOrders');
Route::post('/donut', [AdminController::class, 'donut'])->name('Donut');
Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter'])->name('DashboardFilter');

//APi Doccument gg drive
Route::get('/upload_file', [DocumentController::class, 'upload_file']);
Route::get('/upload_image', [DocumentController::class, 'upload_image']);
Route::get('/upload_video', [DocumentController::class, 'upload_video']);

Route::get('/download_document', [DocumentController::class, 'download_document']);
Route::get('/creat_document', [DocumentController::class, 'creat_document']);
Route::get('/list_document', [DocumentController::class, 'list_document']);
Route::get('/read_document', [DocumentController::class, 'read_document']);
Route::get('/delete_document', [DocumentController::class, 'delete_document']);
//Folder
Route::get('/creat_folder', [DocumentController::class, 'creat_folder']);
Route::get('/rename_folder', [DocumentController::class, 'rename_folder']);
Route::get('/delete_folder', [DocumentController::class, 'delete_folder']);
//Send Mail
Route::get('/send-coupon-vip/{coupon}', [MailAdminController::class, 'sendCouponVip'])->name('CouponVip');
Route::get('/send-coupon/{coupon}', [MailAdminController::class, 'sendCoupon'])->name('CouponNormal');
Route::get('/mail-example', [MailAdminController::class, 'mail_example']);
Route::get('/mail-example-vip', [MailAdminController::class, 'mail_example_vip']);
Route::get('/send-mail', [MailAdminController::class, 'send_mail']);
Route::get('/customer', [AdminController::class, 'customer'])->name('Customer');
Route::get('/customer/change-status', [AdminController::class, 'changeStatus'])->name('ChangeStatusOfCustomer');
//wishlist
Route::get('/wishlist', [ProductController::class, 'wishlist'])->name('Wishlist');
Route::get('/wishlist/fetch', [ProductController::class, 'fetchWishlist'])->name('FetchWishlist');
Route::post('/wishlist/delete', [ProductController::class, 'deleteWishlist'])->name('DeleteWishlist');
Route::post('/wishlist/create', [ProductController::class, 'addWishlist'])->name('AddWishlist');
//Lấy lại mật khẩu
Route::get('/forgot-password', [MailAdminController::class, 'forginPassword']);
Route::post('/forgot-password', [MailAdminController::class, 'checkEmail'])->name('ProcessEmail');
Route::get('/update-new-pass', [MailAdminController::class, 'updateNewPass']);
Route::post('/reset-new-pass', [MailAdminController::class, 'resetNewPass']);
//login-customer-google
Route::get('/login-customer-google', [AdminController::class, 'loginCustomerGoogle']);
Route::get('/customer/google/callback', [AdminController::class, 'CallbackCustomerGoogle']);
//login-customer-facebook
Route::get('/login-customer-facebook', [AdminController::class, 'loginCustomerFacebook']);
Route::get('/customer/facebook/callback', [AdminController::class, 'CallbackCustomerFacebook']);
//Mail accept
Route::get('/mail_order', [CheckoutController::class, 'mailOrder']);
//lịch sử mua hàng
Route::get('/history', [OrderController::class, 'history']);
Route::get('/history/detail/{order_code}', [OrderController::class, 'orderDetail'])->name('OrderDetail');
//Tai khoan
Route::get('/account', [AdminController::class, 'account'])->name('Account');
Route::post('/customer/edit/{id}', [AdminController::class, 'editCustomer'])->name('EditCustomer');
//gio hang
// Route::get('/show-cart', [CartController::class, 'showCartMenu']);
//////////////////////////////////

//category-mxh
Route::get('/add-category-mxh', [CategoryMxhController::class, 'addCategoryMxh']);
Route::get('/edit-category-mxh/{category_mxh_id}', [CategoryMxhController::class, 'editCategoryMxh']);
Route::get('/delete-category-mxh/{category_mxh_id}', [CategoryMxhController::class, 'deleteCategoryMxh']);
Route::get('/all-category-mxh', [CategoryMxhController::class, 'allCategoryMxh']);
Route::get('/unactive-category-mxh/{category_mxh_id}', [CategoryMxhController::class, 'unactiveCategoryMxh']);
Route::get('/active-category-mxh/{category_mxh_id}', [CategoryMxhController::class, 'activeCategoryMxh']);
Route::post('/save-category-mxh', [CategoryMxhController::class, 'saveCategoryMxh']);
Route::post('/update-category-mxh/{category_mxh_id}', [CategoryMxhController::class, 'updateCategoryMxh']);
//MXH
Route::get('/pet-mxh', [SocialController::class, 'PetMXH']);
Route::get('/profile/{customer_id}', [SocialController::class, 'ProfileCustomer']);
Route::post('/add-post', [SocialController::class, 'addPost']);
Route::get('/del-post/{post_id}', [SocialController::class, 'delPost']);
Route::get('/infor/{post_id}', [SocialController::class, 'inFor']);
Route::post('/add-comment-post', [SocialController::class, 'addComment']);
Route::get('/like/{post_id}', [SocialController::class, 'likePost']);

//
Route::get('/all-food', [HomeController::class, 'allFood']);


//Staff
Route::get('/add-staff', [AdminController::class, 'addStaff'])->name('CreateStaff');
Route::get('/all-staff', [AdminController::class, 'getStaff'])->name('Staff');
Route::post('/save-staff', [AdminController::class, 'addNewStaff']);
Route::get('/delete-staff/{admin_id}', [AdminController::class, 'deleteStaff']);
//Vnpay
Route::get('/vn-payment', [VnpayController::class, 'vnPay'])->name('VnPay');
Route::post('/vn-payment', [VnpayController::class, 'vnpayment'])->name('Payment');
Route::get('/vnpay/return', [VNpayController::class, 'vnpayReturn'])->name('vnpay.return');
Route::get('/online', [VNpayController::class, 'online'])->name('online');
Route::get('/check-fee', [VNpayController::class, 'checkFee'])->name('CheckFee');
//Momo
Route::get('/momo-payment', [VnpayController::class, 'momo'])->name('Momo');
Route::get('/momo/return', [VnpayController::class, 'momoReturn'])->name('momo.return');


//Blog
Route::get('/blogs', [BlogController::class, 'blogs'])->name('Blogs');
Route::get('/blog/create', [BlogController::class, 'createBlogs'])->name('CreateBlog');
Route::post('/blog/create', [BlogController::class, 'insertBlogs'])->name('InsertBlog');
Route::get('/blog/edit/{id}', [BlogController::class, 'editBlogs'])->name('EditBlog');
Route::post('/blog/edit/{id}', [BlogController::class, 'saveBlogs'])->name('UpdateBlog');
Route::get('/blog/delete', [BlogController::class, 'deleteBlog'])->name('DeleteBlog');
Route::get('/blog/detail/{id}', [BlogController::class, 'detailBlog'])->name('BlogDetail');
