(function () {
    "use strict";
    window.app.user.security.reset =  ()  => {
        const form = $('#reset-password');
        form.parsley();
        const nextBtnEl = $('#next-step');
        let action = nextBtnEl.attr('input-action');
        const token = $('body').attr('page-token');
        let email = $('.form-item__data-email');
        let question ;


        form.on('submit' , function (e) {
            e.preventDefault();

            nextBtnEl.prop('disabled' , true).
            addClass('btn-secondary');
            email = $('.form-item__data-email');
            action = nextBtnEl.attr('input-action');
            switch (action){
                case 'check-email' :

                   window.axios({
                       method : 'POST',
                       url : '/user/login/reset/password/check/email',
                       headers: {
                           'Accept': 'Application/Json',
                           'Authorization': token
                       },
                       data : {
                           'action' : 'check',
                           'data' : {
                               'email' : email.val(),

                           }
                       }
                   })
                       .then(response=> {
                           setTimeout(()=>  checkEmail(response.data) ,2000)

                       })
                       .catch(error => console.log(error));
                    break;
                case 'code-validation' :

                    window.axios({
                        method : 'POST',
                        url : '/user/login/reset/password/check/email/validation',
                        headers: {
                            'Accept': 'Application/Json',
                            'Authorization': token
                        },
                        data : {
                            'action' : 'check',
                            'data' : {
                                'code' : email.val(),

                            }
                        }
                    })
                        .then(response=> {
                            setTimeout(()=>   confermEmail(response.data) ,2000)

                        })
                        .catch(error => console.log(error));
                    break;
                case 'chnage-password' :
                    window.axios({
                        method : 'POST',
                        url : '/user/login/reset/password/check/email/edit',
                        headers: {
                            'Accept': 'Application/Json',
                            'Authorization': token
                        },
                        data : {
                            'action' : 'edit',
                            'data' : {
                                'password' : email.val(),

                            }
                        }
                    })
                        .then(response=> {

                            changePassword(response.data)

                        })
                        .catch(error => console.log(error));
                    break;
                case 'check-question' :
                    window.axios({
                        method : 'POST',
                        url : '/user/login/reset/password/check/question',
                        headers: {
                            'Accept': 'Application/Json',
                            'Authorization': token
                        },
                        data : {
                            'action' : 'edit',
                            'data' : {
                                'question' : email.val(),

                            }
                        }
                    })
                        .then(response=> {
                            setTimeout(()=>   checkQuestion(response.data),2000)

                        })
                        .catch(error => console.log(error));
                    break;
            }
        })
        function checkEmail({title, body}) {
            nextBtnEl
                .prop('disabled' , false)
                .removeClass('btn-secondary');

            let errorMessagesEl = form.closest('.card-body').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    if(!errorMessagesEl.hasClass('d-none')) errorMessagesEl.addClass('d-none');
                    $('.header-up').removeClass('d-none');
                    nextBtnEl.attr('input-action' , 'code-validation');
                    $('#user-email').val(email.val());
                    $('.data-container_title')
                        .text('Confirmation Code');
                    email
                        .attr('placeholder','Confirmation Code')
                        .attr('type','number')
                        .attr('size','6')
                        .attr('maxlength' , '6')
                        .attr('data-parsley-required-message' , 'confirmation code is required')
                        .removeAttr('minlength')
                        .siblings('.material-icons').html('key');

                    question = body;

                    $('.form-item__footer').removeClass('d-none');
                    break;
                case 'not found' :
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validation':
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
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    errorMessagesEl.removeClass('d-none')
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }



        }
        function confermEmail({title, body}) {
            nextBtnEl
                .prop('disabled' , false)
                .removeClass('btn-secondary');

            let errorMessagesEl = form.closest('.card-body').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    if(!errorMessagesEl.hasClass('d-none')) errorMessagesEl.addClass('d-none');
                    $('.header-up').addClass('d-none');
                    nextBtnEl.attr('input-action' , 'chnage-password');
                    $('.data-container_title')
                        .text('Password');
                    email
                        .attr('placeholder','New Password')
                        .attr('type','text')
                        .attr('maxlength' , '100')
                        .attr('minlength' , '8')
                        .attr('data-parsley-required-message' , 'password is required')
                        .attr('data-parsley-pattern' , '/^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\\]))).{8,32}$/')
                        .removeAttr('size')
                        .val('');

                    $('.form-item__footer').addClass('d-none');


                    break;
                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                   messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

                case 'validation':
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
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }



        }
        function checkQuestion({title, body}) {
            nextBtnEl
                .prop('disabled' , false)
                .removeClass('btn-secondary');

            let errorMessagesEl = form.closest('.card-body').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    if(!errorMessagesEl.hasClass('d-none')) errorMessagesEl.addClass('d-none');
                    $('.header-up').addClass('d-none');
                    nextBtnEl.attr('input-action' , 'chnage-password');
                    $('.data-container_title')
                        .text('Password');
                    email
                        .attr('placeholder','New Password')
                        .attr('type','text')
                        .attr('maxlength' , '100')
                        .attr('minlength' , '8')
                        .attr('data-parsley-required-message' , 'password is required')
                        .attr('data-parsley-pattern' , '/^(?:(?:(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]))|(?:(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\\]))|(?:(?=.*[0-9])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\\]))|(?:(?=.*[0-9])(?=.*[a-z])(?=.*[*.!@$%^&(){}[]:;<>,.?/~_+-=|\\]))).{8,32}$/')
                        .removeAttr('size')
                        .val('');

                    $('.form-item__footer').addClass('d-none');


                    break;
                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

                case 'validation':
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
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }



        }
        function changePassword({title, body}) {
            nextBtnEl
                .prop('disabled' , false)
                .removeClass('btn-secondary');

            let errorMessagesEl = form.closest('.card-body').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    func.refreshPage();
                    setTimeout(() => location.assign("/user/dashboard"), 3000);
                    break;
                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

                case 'validation':
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

            }



        }




        $('#change-with-question').on('click' , function (e) {

            e.preventDefault();
            $('.form-item__footer').addClass('d-none');
            $('.container-title').html('Question Secret');
            $('.data-container_title').text('Response');
            $('#user-email').val(question);
            email
                .attr('placeholder','Response')
                .attr('type','text')
                .attr('maxlength' , '100')
                .attr('minlength' , '1')
                .attr('data-parsley-required-message' , 'response is required')
                .attr('data-parsley-pattern' , '/^[a-zA-Z0-9\\s.,:-_()?!]*$/')
                .val('')
                .removeAttr('size');
            nextBtnEl.attr('input-action' , 'check-question');


        });

    };

})();