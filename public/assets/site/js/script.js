$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    NProgress.configure({showSpinner: true});

    $('.to-top').click(e => {
        e.preventDefault();

        $('html,body').animate({
            scrollTop: 0
        }, 300);
    });

    function closeMobileMenu() {
        $('header').removeClass('menu-expanded');
    }

    function openMobileMenu() {
        $('header').addClass('menu-expanded');
    }

    $('.btn-toggle').click(e => {
        e.preventDefault();
        $('header').toggleClass('menu-expanded');
    });

    $(document).click(function (e) {
        if ($(e.target).closest('.mobile-menu').length === 0 && $(e.target).closest('.btn-toggle').length === 0) {
            closeMobileMenu();
        }
    });

    const loaderElement = `<div class="loader">
                            <svg width="32" height="32" id="loader-former"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 24 24" shape-rendering="geometricPrecision"
                                 text-rendering="geometricPrecision" class="mt-7">
                                <path id="loader-dot-former-1"
                                      d="M0,3C0,1.343146,1.343146,0,3,0C4.656854,0,6,1.343146,6,3C6,4.656854,4.656854,6,3,6C1.343146,6,0,4.656854,0,3Z"
                                      transform="matrix(1 0 0 1 17 9)" opacity="0.9" stroke="none" stroke-width="1"
                                      fill="#757575"></path>
                                <rect id="loader-dot-former-2" width="6" height="6" rx="3" ry="3"
                                      transform="matrix(1 0 0 1 9 9)" opacity="0.6" stroke="none" stroke-width="1"
                                      fill="#9E9E9E"></rect>
                                <rect id="loader-dot-former-3" width="6" height="6" rx="3" ry="3"
                                      transform="matrix(1 0 0 1 0.94007500000000 9)" opacity="0.3" stroke="none"
                                      stroke-width="1" fill="#BDBDBD"></rect>
                            </svg>
                        </div>`;


    $('.btn-has-loader').append(loaderElement);

    let user = null;
    let formIsLoading = false;

    let authTarget = null;

    function authCheck() {
        return $('body').hasClass('authenticated');
    }

    const authModal = new bootstrap.Modal(document.getElementById('authModal'), {
        keyboard: false
    });

    function showAuth() {
        $('.auth-forms input').val('');

        hideLoginForm();
        hideRegisterForm();

        authModal.show();

        $('.auth-forms .mobile-form input:first').focus();
    }

    function hideAuth() {
        authModal.hide();
    }

    $('.open-auth-modal').click(e => {
        closeMobileMenu();
        showAuth();
    });

    $('.auth-forms .register-form input').keyup(e => {
        if (e.keyCode === 13) {
            nextStep();
        }
    });

    $('.auth-forms .btn-next').click(e => {
        nextStep();
    });

    $('.auth-forms .mobile-form').submit(e => {
        checkMobile($('.mobile-form [name=mobile]').val());
        return false;
    });

    $('.auth-forms .login-form').submit(e => {
        login();
        return false;
    });

    $('.auth-forms .register-form').submit(e => {
        register();
        return false;
    });

    let lastEnteredMobile = null;
    let authStatus = null;

    $('.mobile-form [name=mobile]').keyup(function () {
        if (!authStatus) {
            return false;
        }

        const value = $('.mobile-form [name=mobile]').val();
        if (value != lastEnteredMobile) {
            hideLoginForm();
            hideRegisterForm();
            $('.auth-forms .btn-next .title').text('ادامه');
        } else {
            if (authStatus === 'login') {
                showLoginForm();
            } else if (authStatus === 'register') {
                showRegisterForm();
            }
        }
    });

    $('.otp').keyup(function (e) {
        if ($(this).val().length === 6) {
            $(this).blur();
            $(this).parents('form').submit();
        }
    });

    $('.otp-request').click(function (e) {
        if (!$(this).hasClass('disabled')) {
            const mobile = $('.mobile-form').find('[name=mobile]').val();

            if (mobile.length > 0) {
                checkMobile(mobile);
            }
        }
    });

    const showLoginForm = () => {
        $('.login-form').slideDown();
        $('.login-form input:first').focus();
        $('.auth-forms .btn-next .title').text('ورود');
    }

    const hideLoginForm = () => {
        $('.login-form').slideUp();
        $('.login-form input').val('');
    }

    const showRegisterForm = () => {
        $('.auth-forms .error .body').text('آی دی شما اشتباه است!');
        $('.auth-forms').addClass('has-error');

        setTimeout(() => {
            $('.auth-forms').removeClass('has-error');
        }, 5000);
    }

    const hideRegisterForm = () => {
        $('.register-form').slideUp();
        $('.register-form input').val('');
    }

    const nextStep = () => {
        switch (authStatus) {
            case 'login':
                $('.login-form').submit();
                break;
            case 'register':
                $('.register-form').submit();
                break;
            default:
                $('.mobile-form').submit();
                break;
        }
    }

    let canCheckMobile = true;

    const checkMobile = (mobile) => {
        if (formIsLoading && canCheckMobile) {
            return false;
        }

        lastEnteredMobile = mobile;

        const form = $('.mobile-form');
        const inputElementHints = 'input,textarea';

        formIsLoading = true;

        $('.auth-forms').addClass('loading');
        $('.otp-request').addClass('disabled');

        form.find(inputElementHints).removeClass('is-invalid');
        form.find(inputElementHints).removeClass('is-valid');

        $.ajax({
            url: form.attr('action'), method: form.attr('method'), data: {
                mobile: mobile
            }, success: response => {
                if (response.status === true) {
                    authStatus = 'login';
                    hideRegisterForm();
                    showLoginForm();
                } else {
                    // authStatus = 'register';
                    // hideLoginForm();
                    showRegisterForm();
                }

                let duration = 120;

                let timer = duration, minutes, seconds;

                canCheckMobile = false;

                let interval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    $('.otp-request').text(`${minutes}:${seconds} تا درخواست مجدد`);

                    if (--timer < 0) {
                        timer = duration;
                    }

                    if (timer <= 0) {
                        canCheckMobile = true;
                        $('.otp-request').removeClass('disabled');
                        $('.otp-request').text('درخواست مجدد');
                        clearInterval(interval);
                    }
                }, 1000);
            }, error: (jqXHR, status, errorThrown) => {
                const json = jqXHR.responseJSON;
                const statusCode = jqXHR.status;

                if (statusCode === 422) {
                    form.find(inputElementHints).removeClass('is-invalid');

                    Object.keys(json.errors).forEach(key => {
                        const message = json.errors[key][0]
                        let inputElement = form.find(`[name=${key}]`);

                        inputElement.addClass('is-invalid');
                        inputElement.parent().find('.invalid-feedback').text(message);
                    });

                    form.find(`${inputElementHints}:not(.is-invalid)`).addClass('is-valid');
                } else if (statusCode === 429) {
                    $('.auth-forms .error .body').text('درخواست های شما بیش از حد مجاز بوده است. زمان انتظار : 5 دقیقه.');
                    $('.auth-forms').addClass('has-error');

                    setTimeout(() => {
                        $('.auth-forms').removeClass('has-error');
                    }, 5000);
                }

                canCheckMobile = true;
                $('.otp-request').removeClass('disabled');
                $('.otp-request').text('درخواست مجدد');
            }, complete: response => {
                $('.auth-forms').removeClass('loading');
                formIsLoading = false;
            }
        });
    }

    const login = () => {
        if (formIsLoading) {
            return false;
        }

        const form = $('.login-form');
        const inputElementHints = 'input,textarea';

        formIsLoading = true;
        $('.auth-forms').addClass('loading');
        form.find(inputElementHints).removeClass('is-invalid');
        form.find(inputElementHints).removeClass('is-valid');

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize() + '&mobile=' + lastEnteredMobile,
            success: response => {
                if (response.status === true) {
                    syncAuth();
                    hideAuth();
                    authTargetIntend();
                } else {

                }
            },
            error: (jqXHR, status, errorThrown) => {
                const json = jqXHR.responseJSON;
                const statusCode = jqXHR.status;

                if (statusCode === 422) {
                    form.find(inputElementHints).removeClass('is-invalid');

                    Object.keys(json.errors).forEach(key => {
                        const message = json.errors[key][0]
                        let inputElement = form.find(`[name=${key}]`);

                        inputElement.addClass('is-invalid');
                        inputElement.parent().find('.invalid-feedback').text(message);
                    });

                    form.find(`${inputElementHints}:not(.is-invalid)`).addClass('is-valid');
                }
            },
            complete: response => {
                $('.auth-forms').removeClass('loading');
                formIsLoading = false;
            }
        });
    }

    const register = () => {
        if (formIsLoading) {
            return false;
        }

        const form = $('.register-form');
        const inputElementHints = 'input,textarea';

        formIsLoading = true;
        $('.auth-forms').addClass('loading');
        form.find(inputElementHints).removeClass('is-invalid');
        form.find(inputElementHints).removeClass('is-valid');

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize() + '&mobile=' + lastEnteredMobile,
            success: response => {
                if (response.status === true) {
                    syncAuth();
                    hideAuth();
                    authTargetIntend();
                } else {
                    $('.auth-forms .error .body').text(response.body);
                    $('.auth-forms').addClass('has-error');

                    setTimeout(() => {
                        $('.auth-forms').removeClass('has-error');
                    }, 5000);
                }
            },
            error: (jqXHR, status, errorThrown) => {
                const json = jqXHR.responseJSON;
                const statusCode = jqXHR.status;

                if (statusCode === 422) {
                    form.find(inputElementHints).removeClass('is-invalid');

                    Object.keys(json.errors).forEach(key => {
                        const message = json.errors[key][0]
                        let inputElement = form.find(`[name=${key}]`);

                        inputElement.addClass('is-invalid');
                        inputElement.parent().find('.invalid-feedback').text(message);
                    });

                    form.find(`${inputElementHints}:not(.is-invalid)`).addClass('is-valid');
                }
            },
            complete: response => {
                $('.auth-forms').removeClass('loading');
                formIsLoading = false;
            }
        });
    }

    $('.btn-logout:not(.synced)').click(function (e) {
        logout();
        $(this).addClass('synced');
    });

    function syncAuth() {
        $('.auth-sync').addClass('loading');

        $.ajax({
            url: $('meta[name=auth-sync]').attr('content'),
            method: 'post',
            success: response => {
                if (response.status === true) {
                    user = response.user;
                    $('.user-name').text(user.fullname);
                    $('.user-address').html(user.address);

                    $('body').addClass('authenticated');

                    $('.btn-logout:not(.synced)').click(function (e) {
                        logout();
                        $(this).addClass('synced');
                    });

                    if (response.intend) {
                        window.location.href = response.intend;
                    }

                } else {
                    $('.user-name').text(`${response.body}`);
                    $('body').removeClass('authenticated');
                }
            },
            error: (jqXHR, status, errorThrown) => {

            },
            complete: response => {
                $('.auth-sync').removeClass('loading');
            }
        });
    }

    function logout() {
        Swal.fire({
            icon: 'warning',
            title: 'خروج از حساب کاربری',
            html: 'آیا واقعا می خواهید از حساب کاربری خود خارج شوید؟',
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر',
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#d33',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: $('meta[name=auth-logout]').attr('content'),
                    method: 'post',
                    success: response => {
                        return response;
                    },
                    error: (jqXHR, status, errorThrown) => {

                    },
                    complete: response => {
                        $('.auth-sync').removeClass('loading');
                    }
                });
            },
        }).then((result) => {
            const response = result.value;

            if (response && response.status === true) {
                syncAuth();
                $('body').removeClass('authenticated');

                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'خروج موفق',
                        html: `خروج از حساب کاربری با موفقیت انجام گردید!`,
                    });
                }
            }
        });
    }

    function authTargetIntend() {
        if (!authTarget) {
            return false;
        }

        switch (authTarget.type) {
            case 'function':
                eval(authTarget.intendable)
                break;
            case 'click':
                $(authTarget.intendable).click();
                break;
            case 'modal':
                if (authTarget.intendable === 'cartModal') {
                }
                break;
        }

        authTarget = null;
    }

    const url = new URL(window.location.href);
    const urlModal = url.searchParams.get('modal');

    if (urlModal === 'authModal' && !$('body').hasClass('authenticated')) {
        showAuth();
    }
});
