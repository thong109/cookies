<html class="no-js">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon"
        href="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/favicon.png?v=10520349017264832491538730554"
        type="image/png" />
    <title>@yield('title')</title>
    <meta property="og:type" content="website">
    <meta property="og:title" content="Cookie Crumble | Shopify Theme">
    <meta property="og:url" content="https://cookie-crumble-01.myshopify.com/">
    <meta property="og:image"
        content="http://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/logo.png?v=56781279899010714441538730560">
    <meta property="og:image:secure_url"
        content="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/logo.png?v=56781279899010714441538730560">
    <meta property="og:site_name" content="Cookie Crumble | Shopify Theme">
    <meta name="twitter:card" content="summary">
    <!-- Helpers ================================================== -->
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#ffb0b0">
    {!! Html::style('/assets/frontend/home.css') !!}
    {!! Html::style('/assets/frontend/timber.scss.css') !!}
    <link href="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/fonts.min.css?v=146092935489042610131538730555"
        rel="stylesheet" type="text/css" media="all" />
    {!! Html::style('/assets/frontend/styles.css') !!}
    {!! Html::style('/assets/frontend/owl.carousel.min.css') !!}
    {!! Html::style('/assets/flaticon/flaticon.css') !!}
    {!! Html::style('/css/common/client/ionicons.min.css') !!}
    <link
        href="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/owl.theme.default.min.css?v=70915412055662920411538730561"
        rel="stylesheet" type="text/css" media="all" />
    <link
        href="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/magnific-popup.css?v=65451962456944049981538730560"
        rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Comfortaa:300,300italic,400,600,400italic,600italic,700,700italic,800,800italic">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Chewy:300,300italic,400,600,400italic,600italic,700,700italic,800,800italic">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Chewy:300,300italic,400,600,400italic,600italic,700,700italic,800,800italic">
    <!-- Header hook for plugins ================================================== -->
    <script>
        window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');
    </script>
    <meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/21595497/digital_wallets/dialog">
    <script id="shopify-features" type="application/json">{"accessToken":"6c39b110bdf6c573b955ee57a92756cf","betas":["rich-media-storefront-analytics"],"domain":"cookie-crumble-01.myshopify.com","predictiveSearch":true,"shopId":21595497,"smart_payment_buttons_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/spb.en.js?v=2","dynamic_checkout_cart_url":"https:\/\/cdn.shopify.com\/shopifycloud\/payment-sheet\/assets\/latest\/dynamic-checkout-cart.en.js?v=2","locale":"en","optimusEnabled":false}</script>
    <script type="module">!function(o){(o.Shopify=o.Shopify||{}).modules=!0}(window);</script>
    <script>
        ! function(o) {
            function n() {
                var o = [];

                function n() {
                    o.push(Array.prototype.slice.apply(arguments))
                }
                return n.q = o, n
            }
            var t = o.Shopify = o.Shopify || {};
            t.loadFeatures = n(), t.autoloadFeatures = n()
        }(window);
    </script>
    <script integrity="sha256-pfEFLtGor1q9LzHf7xpslSiKa+MZ45v9cHL18ZbWNhI=" data-source-attribution="shopify.loadfeatures"
        defer="defer"
        src="https://cdn.shopify.com/shopifycloud/shopify/assets/storefront/load_feature-a5f1052ed1a8af5abd2f31dfef1a6c95288a6be319e39bfd7072f5f196d63612.js"
        crossorigin="anonymous"></script>
    <script integrity="sha256-h+g5mYiIAULyxidxudjy/2wpCz/3Rd1CbrDf4NudHa4="
        data-source-attribution="shopify.dynamic-checkout" defer="defer"
        src="https://cdn.shopify.com/shopifycloud/shopify/assets/storefront/features-87e8399988880142f2c62771b9d8f2ff6c290b3ff745dd426eb0dfe0db9d1dae.js"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" media="screen"
        href="https://cdn.shopify.com/s/files/1/2159/5497/t/8/compiled_assets/styles.css?2790">
    <script id="sections-script" data-sections="client-logos,top-bar" defer="defer"
        src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/compiled_assets/scripts.js?2790"></script>
    <script>
        window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');
    </script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/header.js?v=168392320446196562711538730584"
        type="text/javascript"></script>
    <script>
        // Wait for window load
        $(window).load(function() {
            //$(".se-pre-con").fadeOut(3000);
            var loader = $('.se-pre-con');
            if (loader.length) {
                $(window).on('beforeunload', function() {
                    loader.fadeIn(500, function() {
                        loader.children().fadeIn(100)
                    });
                });
                loader.fadeOut(1500);
                loader.children().fadeOut();
            }

        });
    </script>
</head>
<body id="cookie-crumble-shopify-theme" class="template-index">
    @include('layouts.template.header')
    @yield('body')
    @include('layouts.template.footer')
    <script>
        $(document).ready(function() {
            var body = $('body');
            var doc = $(document);

            var showLeftPush = $('#showLeftPush');
            var nav = $('#cbp-spmenu-s1');

            showLeftPush.on('click', function(e) {
                e.stopPropagation();

                body.toggleClass('cbp-spmenu-push-toright');
                nav.toggleClass('cbp-spmenu-open');
                showLeftPush.toggleClass('active');
            });

            $('.gf-menu-device-wrapper .close-menu').on('click', function() {
                showLeftPush.trigger('click');
            });

            doc.on('click', function(e) {
                if (!$(e.target).closest('#cbp-spmenu-s1').length && showLeftPush.hasClass('active')) {
                    showLeftPush.trigger('click');
                }
            });
        });
    </script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/timber.js?v=14148509510894400731538730947"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery.inview.js?v=89620651120747506961538730559"
        type="text/javascript"></script>
    <script
        src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery-easing-1.3.js?v=172991260273878369751538730558"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/theme.js?v=183266978712685453701538730584"
        type="text/javascript"></script>
    <script
        src="https://cdn.shopify.com/shopifycloud/shopify/assets/themes_support/option_selection-9f517843f664ad329c689020fb1e45d03cac979f64b9eb1651ea32858b0ff452.js"
        type="text/javascript"></script>
    <script
        src="https://cdn.shopify.com/shopifycloud/shopify/assets/themes_support/api.jquery-e94e010e92e659b566dbc436fdfe5242764380e00398907a14955ba301a4749f.js"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery.history.js?v=97881352713305193381538730559"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/shop.js?v=90635102062993702591540793878"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/owl.carousel.min.js?v=75813715580695946121538730561"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery-ui-totop.js?v=165831731794869972401538730558"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery.tabs.min.js?v=64246396151018283631538730559"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/countdown.js?v=142327016832800231541538730553"
        type="text/javascript"></script>
    <script
        src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery.elevatezoom.js?v=61002758268918306781538730558"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/jquery.fancybox.js?v=41031478351573441371538730558"
        type="text/javascript"></script>
    <!-- Begin quick-view-template -->
    {{-- <div class="clearfix" id="quickview-template" style="display:none">
        <div class="overlay"></div>
        <div class="content clearfix">
            <div class="product-img images">
                <div class="quickview-featured-image product-photo-container"></div>
                <div class="more-view-wrapper">
                    <ul class="product-photo-thumbs quickview-more-views-owlslider owl-carousel owl-theme">
                    </ul>
                    <div class="quick-view-carousel"></div>
                </div>
            </div>
            <div class="product-shop summary">
                <div class="product-item product-detail-section">
                    <h2 class="product-title"><a>&nbsp;</a></h2>
                    <div class="prices product_price">
                        <label>Effective Price : </label>
                        <span class="price h2" id="QProductPrice"></span>
                        <span class="compare-price" id="QComparePrice"></span>
                    </div>
                    <div class="product-infor">
                        <p class="product-inventory"><label>Availability : </label><span></span></p>
                    </div>
                    <div class="details clearfix">
                        <form action="https://cookie-crumble-01.myshopify.com/cart/add" method="post"
                            class="variants">
                            <select name='id' style="display:none"></select>
                            <div class="qty-section quantity-box">
                                <label>Quantity : </label>
                                <div class="dec button qtyminus">-</div>
                                <input type="number" name="quantity" id="Qty" value="1"
                                    class="quantity">
                                <div class="inc button qtyplus">+</div>
                                <div class="actions">
                                    <button type="button" class="add-to-cart-btn btn">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="javascript:void(0)" class="close-window"></a>
        </div>
    </div>
    <div class="loading-modal modal">Loading</div>
    <div class="ajax-error-modal modal">
        <div class="modal-inner">
            <div class="ajax-error-title">Error</div>
            <div class="ajax-error-message"></div>
        </div>
    </div> --}}
    {{-- <div class="ajax-success-modal modal">
        <div class="overlay"></div>
        <div class="content">
            <p class="added-to-cart info">Added to cart</p>
            <p class="added-to-wishlist info">translation missing: en.products.wishlist.added_to_wishlist</p>
            <div class="ajax-left">
                <img class="ajax-product-image" alt="modal window" src="index.html" />
            </div>
            <div class="ajax-right">
                <h3 class="ajax-product-title">Product name</h3>
                <span class="ajax_price"></span>
                <div class="success-message added-to-cart"><a href="https://cookie-crumble-01.myshopify.com/cart"
                        class="btn"><i class="fa fa-shopping-cart"></i>View Cart</a> </div>
                <div class="success-message added-to-wishlist"> <a href="pages/wishlist.html" class="btn"><i
                            class="fa fa-heart"></i>View Wishlist</a></div>
            </div>
            <a href="javascript:void(0)" class="close-modal"><i class="fa fa-times-circle"></i></a>
        </div>
    </div> --}}
    <script type="text/javascript">
        // <![CDATA[
        jQuery(document).ready(function() { //
            var $modalParent = jQuery('div.newsletterwrapper'),
                modalWindow = jQuery('#email-modal'),
                emailModal = jQuery('#email-modal'),
                modalPageURL = window.location.pathname;

            modalWindow = modalWindow.html();
            modalWindow = '<div id="email-modal">' + modalWindow + '</div>';
            $modalParent.css({
                'position': 'relative'
            });
            jQuery('.wrapper #email-modal').remove();
            $modalParent.append(modalWindow);

            if (jQuery.cookie('emailSubcribeModal') != 'closed') {
                openEmailModalWindow();
            };

            jQuery('#email-modal .btn.close').click(function(e) {
                e.preventDefault();
                closeEmailModalWindow();
            });
            jQuery('body').keydown(function(e) {
                if (e.which == 27) {
                    closeEmailModalWindow();
                    jQuery('body').unbind('keydown');
                }
            });
            jQuery('#mc_embed_signup form').submit(function() {
                if (jQuery('#mc_embed_signup .email').val() != '') {
                    closeEmailModalWindow();
                }
            });

            function closeEmailModalWindow() {
                jQuery('#email-modal .modal-window').fadeOut(600, function() {
                    jQuery('#email-modal .modal-overlay').fadeOut(600, function() {
                        jQuery('#email-modal').hide();
                        jQuery.cookie('emailSubcribeModal', 'closed', {
                            expires: 1,
                            path: '/'
                        });
                    });
                })
            }

            function openEmailModalWindow() {
                jQuery('#email-modal').fadeIn(600, function() {
                    jQuery('#email-modal .modal-window').fadeIn(600);
                });
            }

        });
    </script>
    {{-- <div class="newsletterwrapper">
        <div id="email-modal" style="display: none;">
            <div class="modal-overlay"></div>
            <div class="modal-window" style="display: none;">
                <div class="window-window">
                    <a class="btn close" title="Close Window"></a>
                    <div class="window-content">
                        <div class="newsletter-title">
                            <h2 class="title">Get to know the latest offers</h2>
                        </div>
                        <p class="message">Subscribe and get notified at first on the latest update and offers!</p>
                        <div id="mailchimp-email-subscibe">
                            <div id="mc_embed_signup">
                                <form
                                    action="https://myshopify.us2.list-manage.com/subscribe/post?u=057ce5c6d3419dc4a568a2790&amp;id=78371397b0"
                                    method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                                    target="_blank">
                                    <input type="email" value="" placeholder="Email address" name="EMAIL"
                                        id="mail" aria-label="Email address">
                                    <button type="submit" class="" name="subscribe"
                                        id="subscribe">Send</button>
                                </form>
                            </div>
                            <span>Note:we do not spam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/wow.js?v=86079650418477997931538730568"
        type="text/javascript"></script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/classie.js?v=153030108940701990911538730552">
    </script>
    <script
        src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/latest-products.js?v=179838223116983972331538730560">
    </script>
    <script>
        $('.qtyplus').click(function(e) {
            e.preventDefault();
            var currentVal = parseInt($('input[name="quantity"]').val());
            if (!isNaN(currentVal)) {
                $('input[name="quantity"]').val(currentVal + 1);
            } else {
                $('input[name="quantity"]').val(1);
            }

        });

        $(".qtyminus").click(function(e) {

            e.preventDefault();
            var currentVal = parseInt($('input[name="quantity"]').val());
            if (!isNaN(currentVal) && currentVal > 0) {
                $('input[name="quantity"]').val(currentVal - 1);
            } else {
                $('input[name="quantity"]').val(1);
            }
        });
    </script>
    <script type="text/javascript">
        $('.quick-view .close-window').click(function() {
            $('.quick-view').switchClass("open-in", "open-out");
        });
    </script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/uisearch.js?v=60485103324570640781538730567">
    </script>
    <script src="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/magnific-popup.js?v=179434463497768426831538730560"
        type="text/javascript"></script>
    <script type="text/javascript">
        if ($('.p-video').length > 0) {
            $('.jas-popup-url').magnificPopup({
                disableOn: 0,
                tLoading: '<div class="loader"><div class="loader-inner"></div></div>',
                type: 'iframe'
            });
        }
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('.loop').owlCarousel({
                center: true,
                items: 2,
                loop: true,
                margin: 0,
                stagePadding: 50,
                dots: false,
                navContainer: ".divas-navigation",
                navText: ['<a class="prev btn"><i class="icon-arrow-left" ></i></a>',
                    '<a class="next btn"><i class="icon-arrow-right" ></i></a>'
                ],
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 2
                    }
                }
            });
        });
    </script>
</body>

</html>
