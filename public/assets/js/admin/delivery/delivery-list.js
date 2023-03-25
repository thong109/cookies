$(document).ready(function () {
    fetchDelivery();

    function fetchDelivery() {
       $.ajax({
          type: 'GET',
          url: urls.fetchFeeship,
          dataType: 'json',
          success: function (res) {
            var data = res.data;
             var html = '';
             if(res.data.length > 0)
             for (let i = 0; i < res.data.length; i++) {
             html += ('\
                <tr>\
                    <td>'+ data[i]['city']['name_city'] +'</td>\
                    <td>'+ data[i]['province']['name_quanhuyen'] +'</td>\
                    <td>'+ data[i]['wards']['name_xaphuong'] +'</td>\
                    <td contenteditable data-feeship_id="'+ data[i]['fee_id'] +'" class="fee_feeship_edit">'+ data[i]['fee_feeship'] +'</td>\
                </tr>');
             }
             else{
                html += ('\
                <tr>\
                <td colspan="4" class="text-center">No data</td>\
                </tr>');
             }
             $('#load_delivery').html(html);
          },
          error: function () {
             // Notification.Alert(MSG_NO.SERVER_ERROR);
          }
       });
    }

    $(document).on('blur', '.fee_feeship_edit', function() {
        var feeship_id = $(this).data('feeship_id');
        var fee_value = $(this).text();
        $.ajax({
            url: urls.updateDelivery,
            method: 'POST',
            data: {
                feeship_id: feeship_id,
                fee_value: fee_value,
            },
            success: function(data) {
                fetchDelivery();
            }
        });
    });

    $(document).on('change','.choose', function() {
        var action = $(this).attr('id');
        var ma_id = $(this).val();
        var result = '';
        if (action == 'city') {
            result = 'province';
        } else {
            result = 'wards';
        }
        $.ajax({
            url: urls.fetchDelivery,
            method: 'GET',
            data: {
                action: action,
                ma_id: ma_id,
            },
            success: function(res) {
                var html = '';
                var htmlW = '';
                var provinces = res.provinces;
                var wards = res.wards;
                if(res.provinces){
                    html = '<option value="">--- Choose a district ---</option>';
                    for (let i = 0; i < provinces.length; i++) {
                        html += '<option value="' + provinces[i]['maqh'] + '">' + provinces[i]['name_quanhuyen'] + '</option>';
                    }
                    $('#province').html(html);
                }
                if(res.wards){
                    for (let i = 0; i < wards.length; i++) {
                        htmlW += '<option value="' + wards[i]['xaid'] + '">' + wards[i]['name_xaphuong'] + '</option>';
                    }
                    $('#wards').html(htmlW);
                }
            }
        });
    });

    $('.add_delivery').click(function() {
        var city = $('.city').val();
        var province = $('.province').val();
        var wards = $('.wards').val();
        var fee_ship = $('.fee_ship').val();
        $.ajax({
            url: urls.insertDelivery,
            method: 'POST',
            data: {
                city: city,
                province: province,
                wards: wards,
                fee_ship: fee_ship
            },
            success: function(data) {
                fetchDelivery();
            }
        });
    });
 });
