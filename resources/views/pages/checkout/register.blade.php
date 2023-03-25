@section('title', 'Create Account')
@extends('newLayout')
@section('scripts')
    <script>
        const urls = {
            home: '{{ route('Home') }}',
        };
    </script>
    {!! Html::script('public/assets/js/client/account/register.js') !!}
@stop
@section('body')
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <h1>{{ __('Create Account') }}</h1>
        <a href="{{ route('Home') }}" title="Back to the frontpage">{{ __('Home') }}</a>
        <span aria-hidden="true" class="breadcrumb__sep">/</span>
        <span>{{ __('Create Account') }}</span>
    </nav>
    <main class="main-content">
        <div class="dt-sc-hr-invisible-large"></div>
        <div class="wrapper">
            <div class="grid__item">
                <div class="grid">
                    <div class="grid__item small--text-center">
                        <div class="register-form">
                            <form action="{{ route('CreateAccount') }}" id="form-account">
                                <label for="customer_name" class="label--hidden">{{ __('Name') }}</label>
                                <input type="text" name="customer_name" id="customer_name"
                                    placeholder="{{ __('Name') }}" autocapitalize="words" autofocus="">

                                <label for="customer_email" class="label--hidden">{{ __('Email') }}</label>
                                <input type="email" name="customer_email" id="customer_email"
                                    placeholder="{{ __('Email') }}" autocapitalize="words">

                                <label for="customer_phone" class="label--hidden">{{ __('Phone') }}</label>
                                <input type="tel" name="customer_phone" id="customer_phone"
                                    placeholder="{{ __('Phone') }}" autocorrect="off" autocapitalize="off">

                                <label for="customer_address" class="label--hidden">{{ __('Address') }}</label>
                                <input type="text" name="customer_address" id="customer_address"
                                    placeholder="{{ __('Address') }}" autocorrect="off" autocapitalize="off">

                                <label for="customer_password" class="label--hidden">{{ __('Password') }}</label>
                                <input type="password" name="customer_password" id="customer_password"
                                    placeholder="{{ __('Password') }}">
                                <p>
                                    <input type="button" id="btn-save" value="{{ __('Create') }}" class="btn">
                                </p>
                                <a href="{{ route('Home') }}">{{ __('Return to Store') }}</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dt-sc-hr-invisible-large"></div>
    </main>
@stop
