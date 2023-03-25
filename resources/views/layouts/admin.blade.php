<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    {{-- {!! Html::style('/assets/bootstrap-4.4.1/bootstrap.min.css') !!} --}}
    {!! Html::style('/assets/rev-slider/css/rs6.css') !!}
    {!! Html::style('/css/common/client/all.min.css') !!}
    {!! Html::style('/assets/flaticon/flaticon.css') !!}
    {!! Html::style('/css/common/client/ionicons.min.css') !!}
    {!! Html::style('/assets/owl-carousel/owl.carousel.min.css') !!}
    {!! Html::style('/css/common/client/magnific-popup.min.css') !!}
    {!! Html::style('/css/common/client/animate.min.css') !!}
    {!! Html::style('/css/common/client/style.css') !!}
    {!! Html::style('/css/common/client/responsive.css') !!}
    {!! Html::style('/assets/bootstrap-4.4.1/bootstrap.min.css') !!}
    @yield('css')
</head>

<body class="bg-gray-100 text-gray-600">
    <b id="backdrop" onclick="hide_sidebar()"
        class="fixed hidden md:hidden bg-black opacity-60 top-0 left-0 right-0 bottom-0 z-30"></b>
    <div class="flex dark:bg-gray-900">
        @include('layouts.inc.sidebar')
        <main class="w-full">
            @include('layouts.inc.header')
            <section class="container p-6 mx-auto">
                @yield('content')
            </section> <!-- container -->
        </main>
    </div>
    <script>
        var commonUrl = {
            updateDeviceId: ''
        };
        var commonSetting = {
            roles: '',
            oneSignalId: '',
            isPopup: false
        };
    </script>
    {!! Html::script('/js/common/client/jquery-3.4.1.min.js') !!}
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    {!! Html::script('/assets/ckeditor/ckeditor.js') !!}
    {!! Html::script('/assets/popper/popper.min.js') !!}
    {{-- {!! Html::script('/assets/bootstrap-4.4.1/bootstrap.min.js') !!} --}}
    {!! Html::script('/js/common/OneSignalSDK.js') !!}
    {!! Html::script('/assets/jquery/js/jquery-3.2.1.min.js') !!}
    {!! Html::script('/assets/ckeditor/ckeditor.js') !!}
    {!! Html::script('/js/common/admin/popper.min.js') !!}
    {!! Html::script('/assets/bootstrap-3.3.7/js/bootstrap.js') !!}
    {!! Html::script('/js/common/admin/jquery.slimscroll.min.js') !!}
    {!! Html::script('/js/common/admin/select2.min.js') !!}
    {!! Html::script('/js/common/admin/raphael.min.js') !!}
    {!! Html::script('/assets/pagination/js/pagination.js') !!}
    {!! Html::script('/js/common/admin/jquery-form.js') !!}
    {!! Html::script('/js/common/admin/jquery-cookie.js') !!}
    {!! Html::script('/js/common/admin/jquery.dataTables.min.js') !!}
    {!! Html::script('/js/common/admin/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('/js/common/admin/moment.min.js') !!}
    {!! Html::script('/js/common/admin/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('/assets/colorbox/js/jquery.colorbox.js') !!}
    {!! Html::script('/js/common/secure.js') !!}
    {!! Html::script('/js/common/common.js') !!}
    {!! Html::script('/js/common/message.js') !!}
    {!! Html::script('/js/common/notification.js') !!}
    {!! Html::script('/js/common/admin/app.js') !!}
    {!! Html::script('/js/common/admin/admin.js') !!}
    @yield('script')
</body>

</html>
