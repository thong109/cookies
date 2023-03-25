$('.order_details').change(function () {
    var order_status = $(this).val();
    var order_id = $(this).children(":selected").attr("id");
    var _token = $('input[name="_token"]').val();
    product_sale_quantity = [];
    $("input[name='product_sale_quantity']").each(function () {
        product_sale_quantity.push($(this).val());
    });
    order_product_id = [];
    $("input[name='order_product_id']").each(function () {
        order_product_id.push($(this).val());
    });
    j = 0;
    for (i = 0; i < order_product_id.length; i++) {
        var order_qty = $('.order_qty_' + order_product_id[i]).val();
        var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
        if (parseInt(order_qty) > parseInt(order_qty_storage)) {
            j = j + 1;
            if (j == 1) {
                Notification.Alert(MSG_NO.NOT_QTY);
            }
            $('.color_qty_' + order_product_id[i]).css('background', '#000')
        }
    }
    if (j == 0) {
        $.ajax({
            url: urls.updateQty,
            method: 'POST',
            data: {
                _token: _token,
                order_status: order_status,
                order_id: order_id,
                product_sale_quantity: product_sale_quantity,
                order_product_id: order_product_id
            },
            success: function (res) {
                Notification.Alert(MSG_NO.CONFIRM_UPDATE_PRODUCT, function () {
                    window.location = window.location
                });
            }
        });
    }

});
