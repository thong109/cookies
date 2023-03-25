<html class="no-js">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon"
        href="https://cdn.shopify.com/s/files/1/2159/5497/t/8/assets/favicon.png?v=10520349017264832491538730554"
        type="image/png" />
    <title>Cookie Crumble | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#ffb0b0">
    {!! Html::style('public/assets/frontend/styles.css') !!}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="//cdn.shopify.com/s/files/1/2159/5497/t/8/assets/style.css?v=172214781266767785241661750585"
        rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {!! Html::style('public/assets/frontend/sboo.css') !!}
</head>

<body id="cookie-crumble-shopify-theme" class="template-index">
    @yield('bodyCheckout')
    {!! Html::script('public/assets/jquery/js/jquery-3.2.1.min.js') !!}
    {!! Html::script('public/assets/js/common/notification.js') !!}
    {!! Html::script('public/assets/js/common/common.js') !!}
    {!! Html::script('public/assets/js/common/message.js') !!}
    @yield('scripts')
</body>

</html>
