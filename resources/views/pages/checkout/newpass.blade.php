@section('title', 'Reset Account')
@extends('newLayout')
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ __('Reset Account') }}</h1>
        <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Reset Account') }}</span>
    </nav>
    {{-- <section id="form">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-form" style="margin-bottom: 100px">
                        <!--login form-->
                        <?php
                        $token = $_GET['token'];
                        $email = $_GET['email'];
                        ?>
                        <h2>Đặt lại mật khẩu mới</h2>
                        <form action="{{ URL::to('/reset-new-pass') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="email" value="{{ $email }}" />
                            <input type="hidden" name="token" value="{{ $token }}" />
                            <div class="input-box">
                                <i></i>
                                <input type="password" placeholder="Mật khẩu mới" name="password_account" />
                            </div>
                            <button type="submit" class="btn btn-default">Gửi</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
            </div>
        </div>
        <style>
            .login-form {
                width: 100%;
                max-width: 400px;
                margin: 20px auto;
                background-color: #ffffff;
                padding: 15px;
                border: 2px dotted #cccccc;
                border-radius: 10px;
            }

            h1 {
                color: #009999;
                font-size: 20px;
                margin-bottom: 30px;
            }

            .input-box {
                margin-bottom: 10px;
            }

            .input-box input {
                padding: 7.5px 15px;
                width: 100%;
                border: 1px solid #cccccc;
                outline: none;
            }

            .btn-box {
                text-align: right;
                margin-top: 30px;
            }

            .btn-box button {
                padding: 7.5px 15px;
                border-radius: 2px;
                background-color: #009999;
                color: #ffffff;
                border: none;
                outline: none;
            }
        </style>
    </section> --}}
    <!--/form-->
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <?php
                $token = $_GET['token'];
                $email = $_GET['email'];
                ?>
                <div class="grid">
                    <div class="text-center d-flex justify-content-center">
                        <form method="post" action="/account/reset" accept-charset="UTF-8"><input type="hidden"
                                name="form_type" value="reset_customer_password"><input type="hidden" name="utf8"
                                value="✓">
                            <div class="section-header section-header--small text-center">
                                <h1 class="section-header__title">Reset account password</h1>
                            </div>
                            <p>Enter a new password for {{ $email }}</p>
                            <label for="ResetPassword">Password</label>
                            <input type="password" value="" name="customer[password]" id="ResetPassword">
                            <p>
                                <input type="submit" class="btn" value="{{ __('Reset Password') }}">
                            </p>
                            <input type="hidden" name="email" value="{{ $email }}" />
                            <input type="hidden" name="token" value="{{ $token }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@endsection
