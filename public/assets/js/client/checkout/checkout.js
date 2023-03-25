$(document).ready(function () {
    CaculateFee.InitEvents();
});

var CaculateFee = (function () {

    var obj = {
        'city': {
            'type': 'select',
            'attr': {
                'class': 'for-select2 required'
            }
        },
        'province': {
            'type': 'text',
            'attr': {
                'class': 'for-select2 required'
            }
        },
        'wards': {
            'type': 'text',
            'attr': {
                'class': 'for-select2 required'
            }
        },
    }

    var InitEvents = function () {
        try {
            // Click button save
            fetchTotal();

            $(document).on('click', '.caculate_delivery', function () {
                CaculateFee();
            });

            $(document).on('click', '#momo-href', function (e) {
                e.preventDefault();
                vnPay($(this));
            });

            $(document).on('click', '#vnPay-href', function (e) {
                e.preventDefault();
                vnPay($(this));
            });
            $(document).on('click', '#payment-href', function (e) {
                e.preventDefault();
                vnPay($(this));
            });
            $(document).on('click', '#send_order', function () {
                Payment();
            });
        } catch (e) {
            console.log('InitEvents: ' + e.message);
        }
    };

    var NumberFormat = function (x) {
        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(x);
    }

    var CaculateFee = function () {
        if (ValidateModule.Validate(obj)) {
            var data = Common.GetData(obj);
            $.ajax({
                url: urls.caculateFee,
                method: 'POST',
                data: data,
                success: function () {
                    // location.reload();
                    fetchTotal();
                }
            });
        } else {
            ValidateModule.FocusFirstError();
        }
    }

    var fetchTotal = function () {
        $.ajax({
            url: urls.fetchTotal,
            method: 'GET',
            success: function (res) {
                // location.reload();
                html = '';
                html += ('<div class="py-3">\
                <div class="d-flex content-between mb-2">\
                    <div class="">\
                        <span class="">Subtotal</span>\
                    </div>\
                    <div class="">\
                        <span class="">' + NumberFormat(res.total) + '</span>\
                    </div>\
                </div>\
                <div class="d-flex content-between mb-2">\
                    <div class="">\
                        <div class="">\
                            <div class="">\
                                <span class="">Shipping</span>\
                            </div>\
                        </div>\
                    </div>\
                    <div class=""><span class="">' + NumberFormat(res.fee) + '</span></div>\
                </div>\
                <div class="d-flex content-between">\
                    <div class="">\
                        <div class="">\
                            <div class="">\
                                <span class="">Coupon</span>\
                            </div>\
                        </div>\
                    </div>\
                    <div class=""><span class="">- ' + NumberFormat(res.coupon) + '</span></div>\
                </div>\
            </div>\
            <hr>\
            <div class="d-flex content-between py-3">\
                <div class=""><span class="">Total</span></div>\
                <div class="">\
                    <div class="">\
                        <div class="">\
                            <strong class="">' + NumberFormat(res.total - res.coupon + res.fee) + '</strong>\
                        </div>\
                    </div>\
                </div>\
            </div>');
                $('#totalCheckout').html(html);
            }
        });
    }

    var vnPay = function (x) {
        $.ajax({
            type: 'GET',
            url: urls.checkFee,
            contentType: 'application/json',
            success: function (res) {
                if (res.code === 200) {
                    window.location.href = x.attr('href');
                }
                if (res.code === 'E057') {
                    Notification.Alert(res.code, function () {
                        $('#city').css('border', '1px solid red');
                        $('#province').css('border', '1px solid red');
                        $('#wards').css('border', '1px solid red');
                    });
                }
            }
        });
    }

    var Payment = function () {
        var shipping_email = $('.shipping_email').val();
        var shipping_name = $('.shipping_name').val();
        var shipping_address = $('.shipping_address').val();
        var shipping_phone = $('.shipping_phone').val();
        var shipping_notes = $('.shipping_notes').val();
        var shipping_method = $('.shipping_method').val();
        var order_fee = $('.order_fee').val();
        var order_coupon = $('.order_coupon').val();
        $.ajax({
            url: urls.confirmOrder,
            method: 'POST',
            data: {
                shipping_email: shipping_email,
                shipping_name: shipping_name,
                shipping_address: shipping_address,
                shipping_phone: shipping_phone,
                shipping_notes: shipping_notes,
                order_fee: order_fee,
                order_coupon: order_coupon,
                shipping_method: shipping_method
            },
            success: function (res) {
                if (res.data == false) {
                    Notification.Alert(MSG_NO.NOT_QTY_PLUS, function () {
                        window.location = '/home';
                    });
                }
                if (res.data == 'Kotontai') {
                    Notification.Alert(MSG_NO.PRODUCT_NOTFOUND, function () {
                        window.location = '/home';
                    });
                }
                if (res.data == true) {
                    Notification.Alert(MSG_NO.ORDER_SUCCESS, function () {
                        window.location = '/home';
                    });
                }
            }
        });
    };

    return {
        InitEvents: InitEvents
    };
})();
