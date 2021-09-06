(() => {
    "use strict";

    window.app.admin.users.ajaxRequest = () => {
        // global variable
        let updateFormEl = $('#user-up-form');
        let saveFormEl = $('#user-save-form');

        let deleteFormEl = $('#delete-user');
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
        getUserDataBtnEl.click(function () {
            $('#update-user').modal('show'); // show user infos inside form
            /*
                * the user id hashed hidden inside hidden input
                * get the hashed from the current field (this)
            */
            let id = $(this).parent().attr('bootstrap-data-toggle');
            let token = saveFormEl.find(('input[type="hidden"]')).val();
            user_id = id;
            axios({
                method: 'GET',
                url: '/admin/dashboard/users/get',
                headers: {
                    'Authorization': token,
                    "x-user": id
                }
            })
                .then(res => handleGetHttpRequestReturnedData(res.data))
                .catch(error => console.log(error));

        });

        function handleGetHttpRequestReturnedData({title, body}) {
            if (title === 'founded' && body) {
                let userData = body; //here the user obj

                let nameEl = $('#user-up-name');
                let addressEl = $('#user-up-address');
                let cityEl = $('#user-up-city');
                let genderEl = $('#user-up-gender');
                let dateEl = $('#user-up-date');
                let phoneNumberEl = $('#user-up-phoneNumber');
                let emailEl = $('#user-up-email');
                let passwordEl = $('#user-up-ps');
                let inputPhotoEl = $('#user-up-photo');
                let roleEl = $('#user-up-role');
                let compteEtatEl = $('#user-up-compteEtat');
                let secretQuestionEl = $('#user-up-secretQuestion');
                let responseEl = $('#user-up-response');

                //input text
                addressEl.val(userData.user_address).trigger('focus');
                phoneNumberEl.val(userData.user_phoneNumber).trigger('focus');
                emailEl.val(userData.user_email).trigger('focus');
                passwordEl.val(userData.user_password).trigger('focus');
                secretQuestionEl.val(userData.user_secretQuestion).trigger('focus')
                responseEl.val(userData.user_Response).trigger('focus');
                userData.user_gender === 'm' ? genderEl.val('male') : genderEl.val('female');
                dateEl.val(userData.user_dateOfBirth).trigger('focus');

                // select
                userData.user_compteEtat ? compteEtatEl.val(userData.user_compteEtat).trigger('focus') : '';
                userData.user_role ? roleEl.val(userData.user_role).trigger('focus') : '';
                userData.user_gender ? genderEl.val(userData.user_gender === 'm' ? 'male' : 'female').trigger('focus') : '';
                userData.user_ville ? cityEl.val(userData.user_ville) : '';



                // in the dom stay focused
                nameEl.val(userData.user_fullname).trigger('focus');

                $('.custom-input__input')
                    .trigger('change')
                    .trigger('focusout')
                    .trigger('keyup')
                    .trigger('copy')
                    .trigger('paste')
                    .trigger('cut');
            }
        }

        //end get user data


        // http requests / update user
        updateFormEl.on('submit', function (e) {
            e.preventDefault();
            let errorMessagesEl = $('#user-update-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            let fileEl = $('#user-up-photo');
            let tokenEl = updateFormEl.find('input[type="hidden"]');
            let data = new FormData();
            data.append('email', $('#user-up-email').val());
            data.append('name', $('#user-up-name').val());
            data.append('address', $('#user-up-address').val());
            data.append('city', $('#user-up-city').val());
            data.append('gender', $('#user-up-gender').val());
            data.append('date', $('#user-up-date').val());
            data.append('phone', $('#user-up-phoneNumber').val());
            data.append('password', $('#user-up-ps').val());
            data.append('role', $('#user-up-role').val());
            data.append('account', $('#user-up-compteEtat').val());
            data.append('question', $('#user-up-secretQuestion').val());
            data.append('response', $('#user-up-response').val());
            data.append('id', user_id);
            data.append('token', tokenEl.val());

            let _isFile = func.isFile(fileEl);
            _isFile ? data.append('photo', fileEl[0].files[0]) :
                data.append('photo', ' ');

            e.preventDefault();
            if (updateFormEl.parsley().isValid()) {
                axios({
                    method: 'post',
                    url: '/admin/dashboard/users/edit',
                    data: data,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(res => HandleUpdateHttpRequestReturnedData(res.data))
                    .catch(error => console.log(error));




            }
        });

        function HandleUpdateHttpRequestReturnedData({title, body}) {


            let errorMessagesEl = $('#user-update-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':

                    func.refreshPage();
                    func.reloadPageContent('/admin/dashboard/users')

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


        // http requests / get users list
        //get the data from the controller to the view
        // $.ajax({
        //     'url': "/admin/users/edit/d",
        //     'contentType': 'application/json'
        // }).done( function(data) {
        //     let x = JSON.parse(data);
        //     $('#table_id').dataTable( {
        //         "aaData": x,
        //         "columns": [
        //             { "data": "user_id" },
        //             { "data": "user_fullname"}
        //         ]
        //     });
        // })
        //end get users list


        // http requests / add user
        saveFormEl.submit(function (e) {
            let errorMessagesEl = $('#user-save-modal-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            let nameEl = saveFormEl.find('#user-save-name');
            let emailEl = saveFormEl.find('#user-save-email');
            let passwordEl = saveFormEl.find('#user-save-password');
            let tokenEl = saveFormEl.find('input[type="hidden"]');
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/admin/dashboard/users/add',
                dataType: 'json',
                data: {
                    name: nameEl.val(),
                    email: emailEl.val(),
                    password: passwordEl.val(),
                    token: tokenEl.val()
                },
                success: function ({title, body}) {
                    // done , error , used , validator
                    switch (title) {
                        case 'done':
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
                },
                error: function () {
                    alert('');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });


        });
        // add user


        $('.close-session').on('click' , function (){
            axios({
                method: 'post',
                url: '/admin/logout',
                data:{
                    'data' : 'fdgdfg'
                }
            })
                .then(res => {
                    if(res.data.header ==='logout'){
                        func.refreshPage();
                        setTimeout(() => location.assign("/admin"), 3000);
                    }
                })
                .catch(error => console.log(error));


        });

    };
})();
