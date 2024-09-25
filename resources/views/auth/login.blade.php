@extends('home.layouts.home')

@section('title')
    صفحه ی ورود
@endsection
@section('content')
    {{--    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">--}}
    {{--        <div class="container">--}}
    {{--            <div class="breadcrumb-content text-center">--}}
    {{--                <ul>--}}
    {{--                    <li>--}}
    {{--                        <a href="{{route('home.index')}}">صفحه ای اصلی</a>--}}
    {{--                    </li>--}}
    {{--                    <li class="active"> ورود</li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <!-- login----------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-lg">
                <section class="page-account-box">
                    <div class="col-lg-6 col-md-6 col-xs-12 mx-auto">
                        <div class="ds-userlogin">
                            <a href="#" class="account-box-logo">digismart</a>
                            <div class="account-box">
                                <div class="Login-to-account mt-4">
                                    <div class="account-box-content">
                                        <h4 class="mb-2">ورود / عضویت</h4>
                                        {{--                                        <p>شماره موبایل خود را وارد کنید.</p>--}}
                                        <form id="loginForm" class="form-account text-right">
                                            <div class="form-account-title">
                                                <label for="email-phone">شماره موبایل</label>
                                                {{--                                                <input type="text" class="number-email-input" id="email-phone" name="email-account">--}}
                                                <input id="cellphoneInput" class="number-email-input"
                                                       placeholder="شماره موبایل خود را وارد کنید" type="text">
                                                <input type="hidden" name="redirect"
                                                       value="{{ session('url.intended', url('/')) }}">
                                                <div id="cellphoneInputError" class="input-error-validation">
                                                    <strong id="cellphoneInputErrorText"></strong>
                                                </div>
                                            </div>
                                            <div class="form-row-account">
                                                <button class="btn btn-primary btn-login" type="submit"
                                                        id="submitCellphone">ارسال
                                                </button>
                                            </div>
                                        </form>
                                        <form id="checkOTPForm" class="form-account text-right">
                                            <div class="form-account-title">
                                                <input id="checkOTPInput" class="number-email-input"
                                                       placeholder="رمز یک بار مصرف" type="text">
                                                <div id="checkOTPInputError" class="input-error-validation">
                                                    <strong id="checkOTPInputErrorText"></strong>
                                                </div>
                                            </div>
                                            <div class="button-box d-flex justify-content-between mt-4">
                                                <button class="one-time-password-button" type="submit">ورود</button>
                                                <button class="btn btn-primary btn-login one-time-password-button"
                                                        type="submit"
                                                        id="resendOTPButton">ارسال مجدد
                                                </button>
                                                <span id="resendOTPTime"></span>
                                            </div>
                                        </form>
                                        <!-- New User Form -->
                                        <form id="newUserForm" class="form-account text-right">
                                            <div class="form-account-title">
                                            <input id="name_new_user" class="number-email-input" placeholder="نام"
                                                   type="text">
                                            <input id="family_new_user" class="number-email-input"
                                                   placeholder="نام خانوادگی" type="text">
                                            <input id="password_new_user" class="number-email-input"
                                                   placeholder="پسورد" type="password">
                                            <input id="password_confirmation_new_user" class="number-email-input"
                                                   placeholder="تکرار پسورد" type="password">
                                            <div id="newUserFormError" class="input-error-validation">
                                                <strong id="newUserFormErrorText" class="text-danger"></strong>
                                            </div>
                                            </div>
                                            <div class="form-row-account">
                                                <button class="btn btn-primary btn-login" type="submit"
                                                        id="submitCellphone">ثبت نام
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- login----------------------------------->

    {{--    <div class="login-register-area pt-100 pb-100" style="direction: rtl;">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-lg-7 col-md-12 ml-auto mr-auto">--}}
    {{--                    <div class="login-register-wrapper">--}}
    {{--                        <div class="login-register-tab-list nav">--}}
    {{--                            <a class="active" data-toggle="tab" href="#lg1">--}}
    {{--                                <h4> ورود/عضویت </h4>--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                        <div class="tab-content">--}}
    {{--                            <div id="lg1" class="tab-pane active">--}}
    {{--                                <div class="login-form-container">--}}
    {{--                                    <div class="login-register-form">--}}
    {{--                                        <form id="loginForm">--}}
    {{--                                            <input id="cellphoneInput" placeholder="شماره تلفن خود را وارد کنید" type="text">--}}
    {{--                                            <input type="hidden" name="redirect" value="{{ session('url.intended', url('/')) }}">--}}
    {{--                                            <div id="cellphoneInputError" class="input-error-validation">--}}
    {{--                                                <strong id="cellphoneInputErrorText"></strong>--}}
    {{--                                            </div>--}}

    {{--                                            <!-- Password input (hidden initially) -->--}}
    {{--                                            <div id="passwordSection" style="display: none;">--}}
    {{--                                                <input id="passwordInput" placeholder="گذرواژه" type="password">--}}
    {{--                                                <div id="passwordInputError" class="input-error-validation">--}}
    {{--                                                    <strong id="passwordInputErrorText"></strong>--}}
    {{--                                                </div>--}}
    {{--                                                <!-- Option to switch to OTP login -->--}}
    {{--                                                <p><a href="#" id="useOtpLink">ورود با رمز یکبار مصرف</a></p>--}}
    {{--                                                <button type="submit" id="passwordLoginButton">ورود با گذرواژه</button>--}}
    {{--                                            </div>--}}

    {{--                                            <div class="button-box d-flex justify-content-between">--}}
    {{--                                                <button type="submit" id="submitCellphone">ارسال</button>--}}
    {{--                                            </div>--}}
    {{--                                        </form>--}}

    {{--                                        <form id="checkOTPForm">--}}
    {{--                                            <input id="checkOTPInput" placeholder="رمز یک بار مصرف" type="text">--}}
    {{--                                            <div id="checkOTPInputError" class="input-error-validation">--}}
    {{--                                                <strong id="checkOTPInputErrorText"></strong>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="button-box d-flex justify-content-between">--}}
    {{--                                                <button type="submit">ورود</button>--}}
    {{--                                                <div>--}}
    {{--                                                    <button id="resendOTPButton" type="submit">ارسال مجدد</button>--}}
    {{--                                                    <span id="resendOTPTime"></span>--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        </form>--}}

    {{--                                        <!-- New User Form -->--}}
    {{--                                        <form id="newUserForm">--}}
    {{--                                            <input id="name_new_user" placeholder="نام" type="text">--}}
    {{--                                            <input id="family_new_user" placeholder="نام خانوادگی" type="text">--}}
    {{--                                            <input id="password_new_user" placeholder="گذرواژه" type="password">--}}
    {{--                                            <input id="password_confirmation_new_user" placeholder="تأیید گذرواژه" type="password">--}}
    {{--                                            <div id="newUserFormError" class="input-error-validation">--}}
    {{--                                                <strong id="newUserFormErrorText"></strong>--}}
    {{--                                            </div>--}}
    {{--                                            <div class="button-box d-flex justify-content-between">--}}
    {{--                                                <button type="submit">ثبت نام</button>--}}
    {{--                                            </div>--}}
    {{--                                        </form>--}}

    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
@section('script')
    <script>
        let loginToken;
        $('#checkOTPForm').hide();
        $('#resendOTPButton').hide();
        $('#newUserForm').hide(); // Initially hide new user form

        $('#loginForm').submit(function (event) {
            // console.log($('#cellphoneInput').val());
            event.preventDefault();
            $.post("{{url('/login')}}",
                {
                    '_token': "{{csrf_token()}}",
                    'cellphone': $('#cellphoneInput').val()
                }, function (response, status) {
                    console.log(response, status);
                    loginToken = response.login_token;
                    swal({
                        icon: 'success',
                        text: 'رمز یک بار مصرف برای شما ارسال شد.',
                        button: 'حله!',
                        timer: 2000
                    });
                    $('#loginForm').fadeOut();
                    $('#checkOTPForm').fadeIn();
                    timer();

                }).fail(function (response) {
                console.log(response.responseJSON);
                $('#cellphoneInput').addClass('mb-1');
                $('#cellphoneInputError').fadeIn();
                $('#cellphoneInputErrorText').html(response.responseJSON.errors.cellphone[0]);
            });
        });

        // Handle password login submission
        $('#passwordLoginButton').click(function (event) {
            event.preventDefault();
            const cellphone = $('#cellphoneInput').val();
            const password = $('#passwordInput').val();
            $.post("{{url('/login-with-password')}}",
                {
                    '_token': "{{csrf_token()}}",
                    'cellphone': cellphone,
                    'password': password
                }, function (response) {
                    if (response.redirect) {
                        // Redirect the user if login is successful
                        window.location.href = response.redirect;
                    }
                }).fail(function (response) {
                $('#passwordInputErrorText').html(response.responseJSON.errors.password[0]);
                $('#passwordInputError').fadeIn();
            });
        });

        $('#checkOTPForm').submit(function (event) {
            event.preventDefault();
            $.post("{{url('/check-otp')}}",
                {
                    '_token': "{{csrf_token()}}",
                    'otp': $('#checkOTPInput').val(),
                    'login_token': loginToken,
                    'redirect': $('input[name="redirect"]').val()
                }, function (response, status) {
                    console.log(response, status);
                    if (response.new_user) {
                        // Show the new user form if the user is new
                        $('#checkOTPForm').fadeOut();
                        $('#newUserForm').fadeIn();
                    } else if (response.redirect) {
                        // Redirect existing users
                        window.location.href = response.redirect;
                    }
                }).fail(function (response) {
                console.log(response.responseJSON);
                $('#checkOTPInput').addClass('mb-1');
                $('#checkOTPInputError').fadeIn();
                $('#checkOTPInputErrorText').html(response.responseJSON.errors.otp[0]);
            });
        });
        $('#resendOTPButton').click(function (event) {
            event.preventDefault();
            $.post("{{url('/resend-otp')}}",
                {
                    '_token': "{{csrf_token()}}",
                    'login_token': loginToken
                }, function (response, status) {
                    console.log(response, status);
                    loginToken = response.login_token;
                    swal({
                        icon: 'success',
                        text: 'رمز یک بار مصرف جدید برای شما ارسال شد.',
                        button: 'حله!',
                        timer: 2000
                    });
                    $('#resendOTPButton').fadeOut();
                    $('#resendOTPTime').fadeIn();
                    timer();

                }).fail(function (response) {
                // console.log(response.responseJSON);
                swal({
                    icon: 'error',
                    text: 'مشکل در ارسال دوباره ی رمز یک بار مصرف، مجددا تلاش کنید!',
                    button: 'حله!',
                    timer: 2000
                });
            });
        });

        // Handle new user registration form submission
        {{--$('#newUserForm').submit(function (event) {--}}
        {{--    event.preventDefault();--}}
        {{--    $.post("{{url('/register-new-user')}}",--}}
        {{--        {--}}
        {{--            '_token': "{{csrf_token()}}",--}}
        {{--            'name': $('#name_new_user').val(),--}}
        {{--            'family': $('#family_new_user').val(),--}}
        {{--            'password': $('#password_new_user').val(),--}}
        {{--            'password_confirmation': $('#password_confirmation_new_user').val(),--}}
        {{--            'login_token': loginToken--}}
        {{--        }, function (response, status) {--}}
        {{--            console.log(response, status);--}}
        {{--            if (response.redirect) {--}}
        {{--                window.location.href = response.redirect;--}}
        {{--            }--}}
        {{--        }).fail(function (response) {--}}
        {{--        console.log(response.responseJSON);--}}
        {{--        $('#newUserFormError').fadeIn();--}}
        {{--        $('#newUserFormErrorText').html(response.responseJSON.errors.password[0]);--}}
        {{--    });--}}
        {{--});--}}

        $('#newUserForm').submit(function (event) {
            event.preventDefault();
            $.post("{{url('/register-new-user')}}",
                {
                    '_token': "{{csrf_token()}}",
                    'name': $('#name_new_user').val(),
                    'family': $('#family_new_user').val(),
                    'password': $('#password_new_user').val(),
                    'password_confirmation': $('#password_confirmation_new_user').val(),
                    'login_token': loginToken
                }, function (response, status) {
                    console.log(response, status);
                    if (response.redirect) {
                        // Optionally, you can show the success message before redirecting
                        $('#newUserFormSuccess').fadeIn();
                        setTimeout(function () {
                            window.location.href = response.redirect;
                        }, 2000); // Delay for 2 seconds to show the success message
                    } else {
                        $('#newUserFormSuccess').fadeIn(); // Show success message if no redirect
                    }
                }).fail(function (response) {
                console.log(response.responseJSON);
                let errors = response.responseJSON.errors;

                // Clear previous errors
                $('#newUserFormError').fadeOut();
                $('#newUserFormErrorText').html('');

                // Loop through and display all errors
                if (errors) {
                    $('#newUserFormError').fadeIn();
                    $.each(errors, function (key, messages) {
                        $('#newUserFormErrorText').append(`<p>${messages[0]}</p>`);
                    });
                }
            });
        });



        function timer() {
            let time = "1:01";
            let interval = setInterval(function () {
                let countdown = time.split(':');
                let minutes = parseInt(countdown[0], 10);
                let seconds = parseInt(countdown[1], 10);
                --seconds;
                minutes = (seconds < 0) ? --minutes : minutes;
                if (minutes < 0) {
                    clearInterval(interval);
                    $('#resendOTPTime').hide();
                    $('#resendOTPButton').fadeIn();
                }
                ;
                seconds = (seconds < 0) ? 59 : seconds;
                seconds = (seconds < 10) ? '0' + seconds : seconds;
                $('#resendOTPTime').html(minutes + ':' + seconds);
                time = minutes + ':' + seconds;
            }, 1000);
        }
    </script>
@endsection
