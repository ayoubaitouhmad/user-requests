(() => {
    window.app.admin.signup.signup = () => {

        const form = $('#formData');
        const formDataCode = $('#formDataCode');
        const submitformSignup = $('#submit');
        const submitFormDataCode = $('#submit-formDataCode');
        form.parsley();
        formDataCode.parsley();

        // sign up
        submitformSignup.on('click', function (e) {
            e.preventDefault();
            form.submit();
        });
        form.on('submit', function (e) {
            e.preventDefault();
            submitformSignup.addClass('disabled');
            let lname = $('#input-lname');
            let fname = $('#input-fname');
            let username = $('#input-username');
            let email = $('#input-email');
            let password = $('#input-password');
            let phone = $('#input-phone');

            window.axios({
                method: 'POST',
                url: '/admin/signup/admin-infos/check/infos',
                headers: {
                    'Accept': 'Application/Json',
                    'Authorization': 'token'
                },
                data: {
                    'action': 'check',
                    'data': {
                        'first_name': fname.val(),
                        'last_name': lname.val(),
                        'username': username.val(),
                        'email': email.val(),
                        'password': password.val(),
                        'phone': phone.val()
                    }
                }

            })
                .then(res => {
                    handleSignupRequests(res.data);
                    console.log(res.data);
                })
                .catch(error => console.log(error));
        });

        function handleSignupRequests({title, body}) {
            submitformSignup.removeClass('disabled');
            switch (title) {
                case 'done':
                    submitformSignup.addClass('disabled');
                    showMessage(title, body, 'alert-success', form);

                    setTimeout(() => {
                        $(".signup-wrapper").addClass('close-wrapper');
                        $(".emailConfirmation-wrapper").addClass('close-wrapper');
                    }, 3000);


                    break;
                case 'validation':
                    console.log('dfdsf');
                    validationMessages(body, 'alert-info', form);

                    break;
                case 'used':
                    showMessage(title, body, 'alert-warning', form);


                    break;

                case 'error':
                    showMessage(title, body, 'alert-danger', form);
                    break;

            }


        }

        // end sign up


        // check code
        submitFormDataCode.on('click', function (e) {
            e.preventDefault();
            formDataCode.submit();
        });
        formDataCode.on('submit', function (e) {
            e.preventDefault();
            submitFormDataCode.addClass('disabled');
            let code = $('#input-code');
            window.axios({
                method: 'POST',
                url: '/admin/signup/admin-infos/check/email/confirmation-code',
                headers: {
                    'Accept': 'Application/Json',
                    'Authorization': 'token'
                },
                data: {
                    'action': 'check',
                    'data': {
                        'code': code.val(),
                    }
                }

            })
                .then(res => {
                    // handleSignupRequests(res.data);
                         console.log(res.data)
                    handleCheckCodeRequests(res.data);
                })
                .catch(error => console.log(error));
        });

        function handleCheckCodeRequests({title, body}) {
            submitFormDataCode.removeClass('disabled');
            switch (title) {
                case 'done':
                    submitFormDataCode.add('disabled');
                   func.refreshPage();
                   setTimeout(()=>{
                    func.reloadPageContent('/admin')        ;
                   },3000);


                    break;
                case 'validation':

                    validationMessages(body, 'alert-info', formDataCode);

                    break;
                case 'cancel':
                    showMessage(title, body, 'alert-warning', formDataCode);


                    break;

                case 'error':
                    showMessage(title, body, 'alert-danger', formDataCode);
                    break;

            }


        }

        // end code
        function showMessage(title, body, className, errorsContainerParent) {
            let errorMessagesEl = errorsContainerParent.find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            errorMessagesEl.removeClass('d-none');
            func.setClassAdvanced(errorMessagesEl, className);
            messageTitleEl
                .html(body.substring(0, body.indexOf(',')) + ',');

            messageBodyEl
                .html(body.substring(body.indexOf(',') + 1, body.length));
        }

        function validationMessages(body, className, errorsContainerParent) {
            let errorMessagesEl = errorsContainerParent.find('.errors-messages');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            errorMessagesEl.removeClass('d-none');
            func.setClassAdvanced(errorMessagesEl, className,);
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
        }


    };
})();