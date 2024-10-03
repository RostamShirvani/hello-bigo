$(document).ready(function () {
    const csrfToken = $('meta[name=csrf-token]').attr('content');

    $(document).ready(function () {
        $('#items').DataTable({
            responsive: true,
            dom: 'Qlfrtip',
            "language": {
                "url": "/assets/site/plugins/datatables/plugins/1.11.5/i18n/fa.json"
            },
        });
    });

    $('.btn-status').click(function (e) {
        if ($(this).hasClass('disabled')) {
            return false;
        }

        const code = $(this).parents('.booking-item').data('code');
        const title = $(this).data('title');
        const value = $(this).data('value');

        changeBookingStatus(code, value, title);
    });

    const changeBookingStatus = (code, value, title) => {
        Swal.fire({
            icon: 'warning',
            title: 'تغیر وضعیت سفارش',
            html: `آیا از تغییر وضعیت سفارش به <b>${title}</b> اطمینان دارید؟`,
            showCancelButton: true,
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر',
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return $.ajax({
                    url: $('meta[name=booking-status]').attr('content'),
                    data: {
                        code: code,
                        status: value,
                    },
                    method: 'post',
                    success: response => {
                        return response;
                    },
                    error: (jqXHR, status, errorThrown) => {

                    },
                    complete: response => {

                    }
                });
            },
        }).then((result) => {
            const response = result.value;

            if (response && response.status === true) {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'تغییر وضعیت سفارش',
                        html: `وضعیت سفارش با موفقیت به <b>${title}</b> کرد!`,
                    }).then(() => {
                        window.location.replace(response.intend);
                    });

                }
            }
        });
    }

    const showUserPreview = (avatar, name) => {
        $('.user-preview .avatar').css({
            'background-image': `url('${avatar}')`,
        });
        // Update the hidden input field with the account name
        $('input[name="account_avatar_url"]').val(avatar);

        $('.user-preview .name').text(name);
        $('.user-preview').addClass('show');

        // Show confirmation checkbox
        if (name) {
            // Update the hidden input field with the account name
            $('input[name="account_name"]').val(name);
            $('#confirmation-account-name').text(name);
            $('.confirmation-section').show();

            // Disable bigo_id input and hide check_account button
            $('#bigo_id').prop('readonly', true);
            $('#check_account').addClass('d-none');
            $('#edit_account').removeClass('d-none'); // Show edit button
        }
    }

    const hideUserPreview = () => {
        $('.user-preview').removeClass('show');
        $('.confirmation-section').hide(); // Hide the confirmation section

    }

    $('.user-preview-toggler').change(e => {
        hideUserPreview();
        const value = $('.user-preview-toggler').val();
        const appType = $('[name=app_type]').val() ? $('[name=app_type]').val() : 1;

        $.ajax({
            url: '/api/users/getUserDetail',
            data: {
                bigo_id: value,
                app_type: appType,
            },
            method: 'post',
            success: response => {
                if (response.status === true) {
                    showUserPreview(response.avatar, response.nick_name);
                } else {
                    showUserPreview('', 'یافت نشد');
                }
            },
            error: (jqXHR, status, errorThrown) => {
                showUserPreview('', 'یافت نشد');
            },
            complete: response => {

            }
        });
    });

    // Event listener for the "check_account" button
    $('#check_account').click(() => {
        hideUserPreview(); // Hide any previous user preview
        const value = $('.user-preview-toggler-front').val(); // Get user input
        const appType = $('[name=app_type]').val() || 1; // Get app type

        // Perform an AJAX request to get user details
        $.ajax({
            url: '/api/users/getUserDetail', // Replace with your API endpoint
            data: {
                bigo_id: value,
                app_type: appType,
            },
            method: 'post',
            success: response => {
                // Show user preview on successful response
                if (response.status === true) {
                    showUserPreview(response.avatar, response.nick_name);
                } else {
                    // Show default message if user not found
                    showUserPreview('', 'یافت نشد');
                }
            },
            error: (jqXHR, status, errorThrown) => {
                // Show error message in user preview
                showUserPreview('', 'یافت نشد');
            }
        });
    });

    // Event listener for the "edit_account" button
    $('#edit_account').click(() => {
        // Enable bigo_id input and show check_account button
        $('#bigo_id').prop('readonly', false);
        $('#check_account').removeClass('d-none');
        $('#edit_account').addClass('d-none'); // Hide edit button

        // Uncheck the checkbox
        $('#confirmation-checkbox').prop('checked', false);
        // Disable the submit button
        $('#submit-button').prop('disabled', true);
        hideUserPreview();
    });

    // $('.ajax-form').each(function () {
    //     const form = $(this);
    //     const submitButton = form.find('[type=submit]');
    //     const inputElementHints = 'input,textarea';
    //
    //     if (form.hasClass('.ajax-form-no-enter')) {
    //         form.keydown(function (e) {
    //             if (e.keyCode == 13) {
    //                 e.preventDefault();
    //                 return false;
    //             }
    //         });
    //     }
    //
    //     form.submit(function (e) {
    //         e.preventDefault();
    //         form.addClass('loading');
    //         formIsLoading = true;
    //
    //         $.ajax({
    //             url: form.attr('action'),
    //             method: form.attr('method'),
    //             data: form.serialize(),
    //             success: response => {
    //                 if (response.status == true) {
    //                     Swal.fire({
    //                         icon: 'success',
    //                         title: response.message && response.message.title ? response.message.title : 'شارژ موفق',
    //                         html: response.message && response.message.body ? response.message.body : `شارژ حساب با موفقیت انجام گردید!`,
    //                     }).then(e => {
    //                         if (!form.hasClass('not-reload')) {
    //                             window.location.reload();
    //                         }
    //                     });
    //                 } else {
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'عملیات ناموفق',
    //                         html: `${response.message}`,
    //                     });
    //                 }
    //             },
    //             error: (jqXHR, status, errorThrown) => {
    //                 const json = jqXHR.responseJSON;
    //                 const statusCode = jqXHR.status;
    //
    //                 if (statusCode === 422) {
    //                     form.find(inputElementHints).removeClass('is-invalid');
    //
    //                     Object.keys(json.errors).forEach(key => {
    //                         const message = json.errors[key][0]
    //                         let inputElement = form.find(`[name=${key}]`);
    //
    //                         inputElement.addClass('is-invalid');
    //                         inputElement.parent().find('.invalid-feedback').text(message);
    //                     });
    //
    //                     form.find(`${inputElementHints}:not(.is-invalid)`).addClass('is-valid');
    //
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'اطلاعات ناقص',
    //                         html: `لطفا اطلاعات فرم را کامل وارد نمایید!`,
    //                     });
    //                 }
    //             },
    //             complete: response => {
    //                 formIsLoading = false;
    //                 form.removeClass('loading');
    //             }
    //         });
    //
    //         return false;
    //     });
    // });

    const syncToken = (ids, showAlert = false) => {
        if (!Array.isArray(ids)) {
            ids = [ids];
        }

        let iterate = 0;

        const sendRequest = () => {
            if (!ids[iterate]) {
                return false;
            }

            const id = ids[iterate];
            const element = $(`#${id}`);

            element.addClass('loading');

            $.ajax({
                url: '/admin/login-tokens-ajax/sync',
                method: 'POST',
                data: {
                    id: id,
                },
                success: response => {
                    const statusColumn = element.find('.col-status .status');

                    if (response.status == true) {
                        statusColumn.html(`<span class="badge bg-success">${response.message.title}</span>`);
                    } else {
                        statusColumn.html(`<span class="badge bg-danger">${response.message.title}</span>`);

                        if (showAlert) {
                            Swal.fire({
                                icon: 'error',
                                title: response.message.title,
                                html: response.message.body,
                            }).then(e => {
                                element.find('.btn-upadte').click();
                            });
                        }
                    }

                    element.find('.synced_at').html(response.synced_at);
                },
                error: (jqXHR, status, errorThrown) => {

                },
                complete: response => {
                    iterate++;
                    sendRequest();
                    element.removeClass('loading');
                }
            });
        }

        sendRequest();
    }

    $('.btn-create').click(e => {
        saveToken();
    });

    $('.btn-update').click(function () {
        const value = $(this).data('value');
        saveToken(value);
    });

    $('.btn-sync').click(function () {
        const value = $(this).parents('.login-token-item').attr('id');
        syncToken(value, true);
    });

    const loginTokenIds = $('.login-token-item').toArray().map(function (loginToken) {
        return $(loginToken).attr('id');
    })

    syncToken(loginTokenIds);

    const saveToken = (id = null) => {
        Swal.fire({
            title: 'آی دی اکانت خود را وارد نمایید',
            input: 'text',
            inputValue: id ? id : '',
            inputAttributes: {
                autocapitalize: 'off',
            },
            customClass: {
                input: 'text-center direction-ltr',
            },
            showCancelButton: true,
            confirmButtonText: 'جستجو',
            cancelButtonText: 'لغو',
            showLoaderOnConfirm: true,
            preConfirm: (idValue) => {
                return fetch(`/api/users/getUserDetail`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        bigo_id: idValue,
                        send_verification_code: true,
                    })
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                }).catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'کد تایید ارسال شده را وارد نمایید',
                    input: 'text',
                    html: `${result.value.id} <br> ${result.value.nick_name}`,
                    imageUrl: result.value.avatar,
                    inputAttributes: {
                        autocapitalize: 'off',
                    },
                    customClass: {
                        input: 'text-center direction-ltr',
                    },
                    showCancelButton: true,
                    confirmButtonText: 'تایید',
                    cancelButtonText: 'لغو',
                    showLoaderOnConfirm: true,
                    preConfirm: (verificationCode) => {
                        return fetch(`/admin/login-tokens-ajax`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                "X-CSRF-Token": csrfToken,
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                            },
                            body: JSON.stringify({
                                bigo_id: result.value.id,
                                verification_code: verificationCode,
                            })
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        }).catch((error, er1) => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((res) => {
                    if (res.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: res.value.message.title,
                            html: res.value.message.body,
                        }).then(e => {
                            if (id) {
                                syncToken(id);
                            } else {
                                window.location.reload();
                            }
                        });
                    }
                })
            }
        })
    }

    const stateUrl = $('meta[name=state-url]').attr('content');

    $('[data-stateable-id]').click(function () {
        const stateableElement = $(this);
        const stateableId = stateableElement.attr('data-stateable-id');
        const stateableType = stateableElement.attr('data-stateable-type');

        if (stateableElement.hasClass('disabled')) {
            return false;
        }

        stateableElement.addClass('disabled');
        NProgress.start();

        $.ajax({
            url: stateUrl,
            method: 'POST',
            data: {
                stateable_id: stateableId,
                stateable_type: stateableType,
            },
            success: response => {
                if (response.state == 1) {
                    stateableElement.addClass('bg-success');
                    stateableElement.removeClass('bg-danger');
                } else {
                    stateableElement.addClass('bg-danger');
                    stateableElement.removeClass('bg-success');
                }

                stateableElement.text(response.state_text);
                stateableElement.removeClass('disabled');
                NProgress.done();
            }
        })
    });

    $('.btn-save-form').click(function (e) {
        const form = $(this).data('form');
        $(`#${form}`).submit();
    });
});

// document.addEventListener("DOMContentLoaded", function () {
//     const bigoIdInput = document.getElementById("bigo_id");
//     const confirmationCheckbox = document.getElementById("confirmation-checkbox");
//     const submitButton = document.getElementById("submit-button");
//
//     function toggleSubmitButton() {
//         if (bigoIdInput.value.trim() !== '' && confirmationCheckbox.checked) {
//             submitButton.disabled = false;
//         } else {
//             submitButton.disabled = true;
//         }
//     }
//
//     // Listen for changes on the bigo_id input field and checkbox
//     bigoIdInput.addEventListener('input', toggleSubmitButton);
//     confirmationCheckbox.addEventListener('change', toggleSubmitButton);
// });
