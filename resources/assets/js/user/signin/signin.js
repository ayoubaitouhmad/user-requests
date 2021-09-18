(function () {
    "use strict";
    window.app.user.signin.ajax = function () {
        let loginFormEl = $('#login-form');

        // submit form
        loginFormEl.on('submit' , function (e){
             e.preventDefault();
            let emailEl = loginFormEl.find('.form-item__data-email');
            let passwordEl = loginFormEl.find('.form-item__data-password');
            let token = $('body').attr('page-token');
            let validData =  emailEl && passwordEl && token;
            if(loginFormEl.parsley().isValid() && validData){
                window.axios({
                    method : 'post',
                    url : '/user/login/validate',
                    data : {
                        'action' : 'validation',
                        'data' : {
                            'email' : emailEl.val(),
                            'password' : passwordEl.val(),
                        }
                    },
                    headers : {
                        'Authorization' : token
                    }
                })
                    .then(res  => {
                        handleSubmitFormReturnData(res.data);
                    })
                    .catch(error=> console.log(error))
            }else {
                window.location.reload();
            }


        });
        function handleSubmitFormReturnData({header , body}){
            let errorMessagesEl = loginFormEl.closest('.login-container').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');

            switch (header) {
                case 'done':
                    func.refreshPage();
                    setTimeout(() => location.assign("/user/signup/email"), 3000);
                    break;
                case 'not found':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'invalid login':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validation':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
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

                case 'cancel':

                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));

                    break;

                case 'error':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));


                    break;
            }
        }
        // end submit form


    };

})();