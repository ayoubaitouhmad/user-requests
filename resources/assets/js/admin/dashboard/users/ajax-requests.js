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
        // delete modal submit button
        let deleteUserBtnEl = $('#delete-user');

        // buttons
        let submitUpdateFormBtnEl = $('#submit-update-form');
        let submitUserSaveForm = $('#submit-user-save-form');
        let getUserDataBtnEl = $('.ico-edit');



        // page token
        let token = $('body').attr('page-token');

        // http requests / Delete user


        deleteUserBtnEl.on('click', function (e) {
            let $this = $(this);
            let id = $this.closest('.modal').find('input[type="hidden"]').val();

            window.axios({
                method: 'post',
                url: '/admin/dashboard/users/delete',
                data: {
                    'action': 'delete',
                    'data': {
                        'id_enc': id
                    }
                },
                headers: {
                    'Authorization': token
                }
            })
                .then(res =>
                    HandleDeleteHttpRequestReturnedData(res.data)
                )
                .catch(error => {
                    alert('error');
                });

        });
        function HandleDeleteHttpRequestReturnedData({header, body}) {

            let parentEl = deleteUserBtnEl.closest('.modal');
            let errorMessagesEl = parentEl.find('.user-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (header) {
                case 'done':
                    $('body').removeClass('modal-open');
                    func.resetScrolling();
                    func.refreshPage();
                    func.reloadPageContent('/admin/dashboard/users')

                    break;
                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));

                    break;
                case 'error':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-danger');
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));

                    break;
            }

        }

        //end delete user

        // http requests / get user data user
        $(document.body).on('click', '.ico-edit', function (e) {
            console.log('document');
            console.log('getUserDataBtnEl');
            $('#update-user').modal('show'); // show user infos inside form
            /*
                * the user id hashed hidden inside hidden input
                * get the hashed from the current field (this)
            */
            let id =  $(this).closest('tr').attr('row-id');
            token = $('body').attr('page-token');
            $('#user-to-update').text(id);

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
                updateFormName.val(userData.user_fullname);
                updateFormGender.val(userData.user_gender === 'm' ? 'male' : 'female');
                updateFormAddress.val(userData.user_address);
                updateFormRole.val(userData.user_role);
                updateFormSecretQuestion.val(userData.user_secretQuestion);
                updateFormDate.val(userData.user_dateOfBirth);
                updateFormCity.val(userData.user_ville);
                updateFormResponse.val(userData.user_Response);
                updateFormEmail.val(userData.user_email);
                updateFormPhoneNumber.val(userData.user_phoneNumber);
                updateFormAccount.val(userData.user_compteEtat);

                    $('#image-preview').attr('src' ,userData.user_photo !== '' ? userData.user_photo : '/img/unknown.png' );

                $("#user-update-city option").each(function () {
                    if (userData.user_ville === $(this).text()) {
                        updateFormCity.val($(this).val());
                        return false;
                    }
                });


                $('.custom-form__control').each(function (index, element) {
                    let $this = $(element);
                    $this
                        .trigger('focus')
                        .trigger('change')
                        .trigger('focusout')
                        .trigger('keyup')
                        .trigger('copy')
                        .trigger('paste')
                        .trigger('cut');

                });
            }
        }

        //end get user data



        // http requests / update user
        submitUpdateFormBtnEl.on('click', function () {

            updateFormEl.submit();
        })
        updateFormEl.on('submit', function (e) {
            e.preventDefault();
            submitUpdateFormBtnEl.prop('disabled', true);

            let formData = new FormData();
             token = $('body').attr('page-token');
            formData.append('id', $('#user-to-update').text() ?? user_id);
            formData.append('name', updateFormName.val());
            formData.append('gender', updateFormGender.val());
            formData.append('address', updateFormAddress.val());
            formData.append('role', updateFormRole.val());
            formData.append('question', updateFormSecretQuestion.val());
            formData.append('date', updateFormDate.val());
            formData.append('city',updateFormCity.find(":selected").text());
            formData.append('response', updateFormResponse.val());
            formData.append('email', updateFormEmail.val());
            formData.append('phone', updateFormPhoneNumber.val());
            formData.append('account', updateFormAccount.val());
            if (func.isFile(updateFormPhoto)) formData.append('photo', updateFormPhoto.get(0).files[0]);
            if (updateFormEl.parsley().isValid()) {

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
                        HandleUpdateHttpRequestReturnedData(res.data)
                    })
                    .catch(error => console.log(error));
            }
        });
        function HandleUpdateHttpRequestReturnedData({title, body}) {
            submitUpdateFormBtnEl.prop('disabled', false);
            let errorMessagesEl = updateFormEl.find('.modal-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    errorMessagesEl.addClass('d-none');
                    setTimeout(()=>{
                        $('#update-user').modal('hide'); // show user infos inside form
                        $('body').removeClass('modal-open');
                        func.resetScrolling();
                        func.refreshPage();
                        func.reloadPageContent('/admin/dashboard/users')
                    },100)


                    break;
                case 'used':
                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validation':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-info');
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
                    func.setClassAdvanced(errorMessagesEl, 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

            }

        }
        //end update user


        // http requests / add user
        saveFormEl.submit(function (e) {
            e.preventDefault();
            submitUserSaveForm.prop('disabled' , true);


            let nameEl = saveFormEl.find('#user-save-name');
            let emailEl = saveFormEl.find('#user-save-email');
            let phone = saveFormEl.find('#user-save-phone');
            let passwordEl = saveFormEl.find('#user-save-password');
             token = $('body').attr('page-token');
            if(saveFormEl.parsley().isValid()){
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
                    .then(response =>
                        handleSaveFormReturnData(response.data))
                    .catch(error => {
                        alert('please try again.')
                        location.reload();
                    })
            }



        });
        function handleSaveFormReturnData({header, body}) {
            submitUserSaveForm.prop('disabled' , false);
            let errorMessagesEl = saveFormEl.closest('.modal-body').find('#user-save-modal-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (header) {
                case 'done':
                    $('#update-user').modal('hide'); // show user infos inside form
                    $('body').removeClass('modal-open');
                    func.resetScrolling();
                    func.refreshPage();
                    func.reloadPageContent('/admin/dashboard/users')
                    break;
                case 'used':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');
                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validator':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-info');
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
                    func.setClassAdvanced(errorMessagesEl, 'alert-danger');
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
