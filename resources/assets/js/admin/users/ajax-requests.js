(() => {
    "use strict";

    window.app.admin.users.ajaxRequest = () => {
        // global variable
        // update form
        let updateFormEl = $('#user-up-form');
        // update form fields
        let updateFormName = $('#user-update-name');
        let updateFormGender = $('#user-update-gender');
        let updateFormAddress = $('#user-update-address');
        let updateFormRole = $('#user-update-role');
        let updateFormSecretQuestion = $('#user-update-secretQuestion');
        let updateFormDate = $('#user-update-date');
        let updateFormCity = $('#user-update-city');
        let updateFormResponse = $('#user-update-response');
        let updateFormEmail = $('#user-update-email');
        let updateFormPhoneNumber = $('#user-update-phoneNumber');
        let updateFormAccount = $('#user-update-account');
        let updateFormPhoto = $('#user-update-photo');
        let updateFormPhotoContainer = $('.user-update-photo__container');
        // end update form

        // add form
        let saveFormEl = $('#user-save-form');
        //delete modal
        let deleteFormEl = $('#delete-user');

        // buttons
        let submitUpdateFormBtnEl = $('#submit-update-form');
        let getUserDataBtnEl = $('.ico-edit');
        let user_id;


        // http requests / Delete user
        deleteFormEl.on('click', function (e) {
            let $this = $(this);
            let id = $this.closest('.modal').find('input[type="hidden"]').val();
            let token = saveFormEl.find(('input[type="hidden"]')).val();
            axios({
                method: 'post',
                url: '/admin/dashboard/users/delete',
                data: {
                    'type': 'post',
                    'crud': 'delete',
                    'data': {id_enc: id}
                },
                headers: {
                    'Authorization': token
                }
            })
                .then(res => HandleDeleteHttpRequestReturnedData(res.data))
                .catch(error => console.log(error));

        });

        function HandleDeleteHttpRequestReturnedData({header, body}) {
            let parentEl = deleteFormEl.closest('.modal');
            let errorMessagesEl = parentEl.find('.user-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (header) {
                case 'done':
                    func.refreshPage();
                    func.reloadPageContent('/admin/dashboard/requests');
                    $('.modal').modal('hide');
                    func.resetScrolling();
                    break;
                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));

                    break;
                case 'error':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));


                    break;
            }

        }

        //end delete user

        // http requests / get user data user
        getUserDataBtnEl.on('click', function () {

            $('#update-user').modal('show'); // show user infos inside form
            /*
                * the user id hashed hidden inside hidden input
                * get the hashed from the current field (this)
            */
            let id = getUserDataBtnEl.closest('tr').attr('row-id');
            let token = $('body').attr('page-token');
            user_id = id;

            window.axios({
                method: 'GET',
                url: '/admin/dashboard/users/get',
                headers: {
                    'Authorization': token,
                    "x-user": id
                }
            })
                .then(res => {

                    handleGetUserDataReturnData(res.data)
                })
                .catch(error => console.log(error));

        });

        function handleGetUserDataReturnData({title, body}) {
            if (title === 'founded' && body !== false) {
                let userData = body; //here the user obj
                updateFormName.val(userData.user_fullname).trigger('focus');
                updateFormGender.val(userData.user_gender === 'm' ? 'male' : 'female').trigger('focus');
                updateFormAddress.val(userData.user_address).trigger('focus');
                updateFormRole.val(userData.user_role).trigger('focus');
                updateFormSecretQuestion.val(userData.user_secretQuestion).trigger('focus');
                updateFormDate.val(userData.user_dateOfBirth).trigger('focus');
                updateFormCity.val(userData.user_ville).trigger('focus');
                updateFormResponse.val(userData.user_Response).trigger('focus');
                updateFormEmail.val(userData.user_email).trigger('focus');
                updateFormPhoneNumber.val(userData.user_phoneNumber).trigger('focus');
                updateFormAccount.val(userData.user_compteEtat).trigger('focus');
                updateFormPhotoContainer.attr('src', userData.user_photo);






                //
                // $('.custom-file-input')
                //     .trigger('change')
                //     .trigger('focus')
                //     .trigger('focusout')
                //     .trigger('keyup')
                //     .trigger('copy')
                //     .trigger('paste')
                //     .trigger('cut');
            }
        }

        //end get user data


        // http requests / update user
        submitUpdateFormBtnEl.on('click', function () {
            submitUpdateFormBtnEl.prop('disabled', true);
            updateFormEl.submit();


        })
        updateFormEl.on('submit', function (e) {
            e.preventDefault();


            let formData = new FormData();
            let token = $('body').attr('page-token');
            formData.append('id', user_id);
            formData.append('name', updateFormName.val());
            formData.append('gender', updateFormGender.val());
            formData.append('address', updateFormAddress.val());
            formData.append('role', updateFormRole.val());
            formData.append('question', updateFormSecretQuestion.val());
            formData.append('date', updateFormDate.val());
            formData.append('city', updateFormCity.val());
            formData.append('response', updateFormResponse.val());
            formData.append('email', updateFormEmail.val());
            formData.append('phone', updateFormPhoneNumber.val());
            formData.append('account', updateFormAccount.val());
            if (func.isFile(updateFormPhoto)) formData.append('photo', updateFormPhoto.get(0).files[0]);

            if (updateFormEl.parsley().isValid()) {
                submitUpdateFormBtnEl.prop('disabled', false);
                window.axios({
                    method: 'post',
                    url: '/admin/dashboard/users/edit',
                    data: formData
                    ,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization': token
                    }
                })
                    .then(res => {
                        HandleUpdateHttpRequestReturnedData(res.data);
                        // HandleUpdateHttpRequestReturnedData(res.data)
                    })
                    .catch(error => console.log(error));
            }
        });

        function HandleUpdateHttpRequestReturnedData({title, body}) {


            let errorMessagesEl = updateFormEl.find('#user-update-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    $('#update-user').modal('hide'); // show user infos inside form
                    $('body').removeClass('modal-open');
                    func.resetScrolling();
                    func.refreshPage();
                    func.reloadPageContent('/admin/dashboard/users')

                    break;
                case 'used':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'sql':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validator':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    if (body === "") {
                        errorMessagesEl.addClass('d-none');
                    } else {
                        let arrays = Object.values(body);
                        if (arrays.find(x => x !== undefined) !== undefined) {
                            let firstArray = arrays.find(x => x !== undefined);
                            if (arrays.find(x => x !== undefined) !== undefined) {
                                if (firstArray.find(x => x !== undefined) !== undefined) {
                                    messageBodyEl.text(firstArray.find(x => x !== undefined));
                                }
                            }
                        }
                    }


                    break;
                case 'error':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    errorMessagesEl.removeClass('d-none')
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

            }


        }

        //end update user


        // http requests / add user
        saveFormEl.submit(function (e) {
            e.preventDefault();


            let nameEl = saveFormEl.find('#user-save-name');
            let emailEl = saveFormEl.find('#user-save-email');
            let phone = saveFormEl.find('#user-save-phone');
            let passwordEl = saveFormEl.find('#user-save-password');
            let token = $('body').attr('page-token');


            window.axios({
                method: 'POST',
                headers: {
                    'Authorization': token
                },
                data: {
                    'action': 'add',
                    'data': {
                        'name': nameEl.val(),
                        'email': emailEl.val(),
                        'password': passwordEl.val(),
                        'phone': phone.val(),
                    }
                },
                url: '/admin/dashboard/users/add'
            })
                .then(response => handleSaveFormReturnData(response.data))
                .catch(error => {
                    alert('please try again.')
                    location.reload();
                })


        });

        function handleSaveFormReturnData({header, body}) {

            let errorMessagesEl = saveFormEl.find('#user-save-modal-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (header) {
                case 'done':
                    $('.modal').modal('hide');
                    func.resetScrolling();
                    $('body').load('/page/refresh');
                    $('[data-toggle="minimize"]').click();
                    setTimeout(function () {
                        $('body').load('/admin/dashboard/users');
                        $('[data-toggle="minimize"]').click();
                    }, 3000);

                    break;
                case 'used':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validator':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    let arrays = Object.values(body);
                    if (arrays.find(x => x !== undefined) !== undefined) {
                        let firstArray = arrays.find(x => x !== undefined);
                        if (arrays.find(x => x !== undefined) !== undefined) {
                            if (firstArray.find(x => x !== undefined) !== undefined) {
                                messageTitleEl.html('');
                                messageBodyEl.text(firstArray.find(x => x !== undefined));
                            }
                        }
                    }
                    break;
                case 'error':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    errorMessagesEl.removeClass('d-none')
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }
        }

        // add user


    };
})();
