<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coupon</title>
    <style>
        .khuyen-mai-hb {
            margin-bottom: 2px;
            margin-top: 2px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ef0b0b;
            font-size: 15px;
            width: 90%;
        }

        .khuyen-mai-hb .tieu-de {
            background: #e31616;
            padding: 2px 20px;
            margin-top: -24px;
            font-size: 15px;
            font-weight: 500;
            color: #ffffff;
            display: block;
            max-width: 207px;
            border-radius: 99px;
        }

        .khuyen-mai-hb ul {
            margin-bottom: 4px;
            list-style-image: url(tick.png);
        }

        li {
            list-style: none;
        }
    </style>
</head>

<body>
    <div class="khuyen-mai-hb">
        <span class="tieu-de"><i class="icon-gift"></i> {{ $coupon['coupon_name'] }}</span>
        <ul>
            <li>Bạn được tặng 1 mã giảm
                {{ $coupon['coupon_condition'] == 2
                    ? number_format($coupon['coupon_number']) . ' VND'
                    : $coupon['coupon_number'] . ' %' }}
                khi mua hàng</li>
            <li>Hạn sử dụng {{ $coupon['end_coupon'] }}</li>

        </ul>
        <a href="{{route('Coupon')}}" target="_blank">Xem ngay</a>
    </div>
</body>

</html>
