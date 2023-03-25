<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::to('public/blog/css/style.css') }}">
    <title>Profle - Socialbook</title>
    <script src="https://kit.fontawesome.com/ef7e2b893b.js" crossorigin="anonymous"></script>
    <script src="http://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <link href="{{ asset('public/frontend/icon/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <style>
        p img {
            width: 100%;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-left"><a href="{{URL::to('pet-mxh')}}"><img class="logo" src="{{ URL::to('public/frontend/images/logopet.jpg') }}"
            alt=""></a>
        </div>
        <div class="nav-right">
            <div class="profile-darkButton">
                <div>
                    <a href="{{URL::to('/logout-checkout')}}" class="btn btn-default" style="text-decoration: none; color: #626262;font-weight:500">Đăng
                        xuất</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- profile-page-------------------------- -->


    <div class="profile-container">
        <div class="dashboard">
            <div class="left-dashboard">
                <img src="images/profile.png" class="dashboard-img" alt="">
                <div class="left-dashboard-info">
                    <h3>{{ $customer->customer_name }}</h3>
                    <div class="mutual-friend-images">
                        <img src="images/member-1.png" alt="">
                        <img src="images/member-2.png" alt="">
                        <img src="images/member-3.png" alt="">
                        <img src="images/member-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>


        <div class="container content-profile-container">
            <div class="left-sidebar profile-left-sidebar">
                <div class="left-profile-sidebar-top">
                    <div class="intro-bio">
                        <h4>intro</h4>
                        <p>Belive in yourself and you do unbelievable things <i class="far fa-smile-beam"></i></p>
                        <hr>
                    </div>
                    <div class="background-details">
                        <a href="#"><i class="fas fa-phone"></i>
                            <p>{{ $customer->customer_phone }}</p>
                        </a>

                    </div>
                </div>
            </div>
            <!-- main-content------- -->

            <div class="content-area profile-content-area">
                <div class="write-post-container">

                    <body>
                        <button id="myBtn">
                            <p style="color:#fff;padding:5px;background:#1876f2;border-radius:5px">Thêm bài viết</p>
                        </button>
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <p>Thêm bài viết</p>
                                <form action="{{ URL::to('add-post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="post_desc" placeholder="Tên bài viết"
                                            class="form-control mb-2">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="post_image" class="form-control mb-2">
                                    </div>
                                    <div class="form-group mb-2">
                                        <select name="post_desc_mxh" class="form-control input-lg m-bot15">
                                            @foreach ($cateMxh as $key => $cate)
                                                @if ($cate->category_mxh_id == $cate->category_mxh_id)
                                                    <option selected value="{{ $cate->category_mxh_id }}">
                                                        {{ $cate->category_mxh_name }}</option>
                                                @else
                                                    <option selected value="{{ $cate->category_mxh_id }}">
                                                        {{ $cate->category_mxh_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="post-upload-textarea">
                                        <textarea style="resize: none" rows="5" cols="30" id="post_content" name="post_content"></textarea>
                                        <script>
                                            CKEDITOR.replace('post_content');
                                        </script>
                                        <div class="add-post-links">
                                            <button type="submit"
                                                style="color:black;padding:10px;background:#1876f2;border-radius:10px">Đăng</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                @foreach ($postUser as $post)
                    <div class="status-field-container write-post-container">
                        <div class="user-profile-box">
                            <div class="user-profile">

                                <div>
                                    <p>{{ Session::get('customer_name') }}</p>
                                    <small>{{ $post->created_at }}</small>
                                </div>
                            </div>
                            @if (Session::get('customer_id') == $post->customer_id)
                                <div>
                                    <a href="{{ URL::to('/del-post/' . $post->post_id) }}" title="Xóa bài đăng"><i
                                            class="fas fa-times"></i></a>
                                </div>
                            @endif
                        </div>
                        <div class="status-field">
                            <p>
                                {!! $post->post_content !!}
                            </p>
                        </div>
                        <div class="post-reaction">
                            <div class="activity-icons">
                                <div><i class="pegk pe-7s-like2"></i></div>
                                <div><i class="pegk pe-7s-like"></i></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <footer id="footer">
        <p>&copy; Copyright 2021 - Socialbook All Rights Reserved</p>
    </footer>

    <script src="{{ URL::to('public/blog/js/function.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.18.0/basic/ckeditor.js"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>
