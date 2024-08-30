<div class="modal fade no-select" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">ورود</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-5">
                <div class="auth-forms">
                    <form class="mobile-form" method="post" action="{{ route('site.auth.ajax.check') }}">
                        <div class="container px-md-3 px-sm-4 px-lg-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="mobile" class="form-label">
                                        {{ __trans('site/booking', 'mobile') }}
                                    </label>
                                    <input type="number"
                                           class="form-control numeric"
                                           id="mobile"
                                           name="mobile"
                                           value="{{ old('mobile') }}"
                                           placeholder="{{ __trans('site/auth', 'enter-mobile') }}"
                                           autocomplete="off"
                                           pattern="\d*"
                                           required>
                                    <div class="valid-feedback">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __trans('validation', 'looks-wrong') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form class="login-form mt-2"
                          method="post"
                          action="{{ route('site.auth.ajax.login') }}"
                          style="display: none">
                        <div class="container px-md-3 px-sm-4 px-lg-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="otp" class="form-label">
                                        {{ __trans('site/auth', 'otp') }}
                                        <div class="otp-request"></div>
                                    </label>
                                    <input type="number"
                                           class="form-control numeric otp"
                                           data-mask="000000"
                                           data-mask-reverse="true"
                                           maxlength="6"
                                           id="otp"
                                           name="otp"
                                           value="{{ old('otp') }}"
                                           autocomplete="off"
                                           required>
                                    <div class="valid-feedback">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __trans('validation', 'looks-wrong') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form class="register-form mt-2"
                          method="post"
                          action="{{ route('site.auth.ajax.register') }}"
                          style="display: none">
                        <div class="container px-md-3 px-sm-4 px-lg-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name" class="form-label">
                                        {{ __trans('site/auth', 'name') }}
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           name="name"
                                           value="{{ old('name') }}"
                                           placeholder="{{ __trans('site/auth', 'enter-name') }}"
                                           autocomplete="off"
                                           required>
                                    <div class="valid-feedback">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __trans('validation', 'looks-wrong') }}
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="surname" class="form-label">
                                        {{ __trans('site/auth', 'surname') }}
                                    </label>
                                    <input type="text"
                                           class="form-control"
                                           id="surname"
                                           name="surname"
                                           value="{{ old('surname') }}"
                                           placeholder="{{ __trans('site/auth', 'enter-surname') }}"
                                           autocomplete="off"
                                           required>
                                    <div class="valid-feedback">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __trans('validation', 'looks-wrong') }}
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="register-otp" class="form-label">
                                        {{ __trans('site/auth', 'otp') }}
                                        <div class="otp-request"></div>
                                    </label>
                                    <input type="number"
                                           class="form-control numeric otp"
                                           data-mask="0000"
                                           data-mask-reverse="true"
                                           maxlength="4"
                                           id="register-otp"
                                           name="otp"
                                           value="{{ old('otp') }}"
                                           autocomplete="off"
                                           required>
                                    <div class="valid-feedback">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ __trans('validation', 'looks-wrong') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="container px-md-3 px-sm-4 px-lg-5 mt-md-0 mt-sm-0 mt-lg-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="error">
                                    <div class="icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
                                    <div class="body">{{ __trans('site/auth', 'register-error-body') }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-next btn-has-loader" type="submit">
                                    <div class="title">ادامه</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
