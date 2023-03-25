@section('title', 'Login')
@extends('newLayout')
@section('scripts')
    <script>
        const loginUrl = {
            home: '{{ route('Home') }}',
            loginCustomer: '{{ route('LoginCustomer') }}',
            login: '{{ route('Login') }}',
            processEmail: '{{ route('ProcessEmail') }}',
        };
    </script>
    {!! Html::script('public/assets/js/client/account/login.js') !!}
@stop
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ __('Account') }}</h1>
        <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Account') }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="grid">
                    <div class="grid__item small--text-center">
                        <div class="note form-success" id="ResetSuccess" style="display:none;">
                            {{ __("We've sent you an email with a link to update your password.") }}
                        </div>
                        <div id="CustomerLoginForm">
                            <form id="form-login">
                                <label for="customer_email" class="label--hidden">{{ __('Email') }}</label>
                                <input type="email" name="email" id="customer_email" placeholder="{{ __('Email') }}"
                                    autocorrect="off" autocapitalize="off" autofocus="">
                                <label for="customer_password" class="label--hidden">{{ __('Password') }}</label>
                                <input type="password" value="" name="password" id="customer_password"
                                    placeholder="{{ __('Password') }}">
                                <p>
                                    <a href="#" id="showRecoverPasswordForm">{{ __('Forgot your password?') }}</a>
                                </p>
                                <p>
                                    <input type="butotn" id="btn-login" class="btn" value="{{ __('Sign In') }}">
                                </p>
                                <a href="{{ route('Home') }}">{{ __('Return to Store') }}</a>
                            </form>
                            <div style="display: flex;flex-direction:column">
                                <span><a
                                        href="{{ URL::to('/login-customer-facebook') }}">{{ __('Login with Facebook') }}</a>
                                </span>
                                <span><a
                                        href="{{ URL::to('/login-customer-google') }}">{{ __('Login with Google') }}</a></span>
                            </div>
                        </div>
                        <div id="RecoverPasswordForm" style="display: none;">
                            <div class="section-header section-header--small">
                                <h2 class="section-header__title">{{ __('Reset your password') }}</h2>
                            </div>
                            <p>{{ __('We will send you an email to reset your password.') }}</p>
                            <form id="forgot-password-form">
                                <label for="email" class="label--hidden">{{ __('Email') }}</label>
                                <input type="email" value="" name="email" id="email"
                                    placeholder="{{ __('Email') }}" autocorrect="off" autocapitalize="off">
                                <p>
                                    <input type="button" class="btn" id="btn-forget-pasword" value="{{ __('Submit') }}">
                                </p>
                                <a href="#" id="hideRecoverPasswordForm">{{ __('Cancel') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@endsection
