(() => {
    "use strict";

    window.app.user.signup = () => {
        let signFormEl = $('#signup-form');
        signFormEl.parsley();

        // sign up
        signFormEl.on('submit', function (e) {
            e.preventDefault();
            signFormEl.find('input[type="submit"]').attr('disabled' , true);
            let emailEl = signFormEl.find(('.form-item__data-email'));
            let phoneEl = signFormEl.find(('.form-item__data-phone'));
            let passwordEl = signFormEl.find(('.form-item__data-password'));
            let nameEl = signFormEl.find(('.form-item__data-name'));
            let token = $('body').attr('page-token');
            // her if form valid
            axios({
               method : 'post',
               url : '/user/signup',
                data : {
                   'action' : 'post' ,
                    'data' : {
                        'name' : nameEl.val(),
                        'email' : emailEl.val(),
                        'phone' : phoneEl.val(),
                        'password' : passwordEl.val()
                    }
                },
                headers : {
                   'Authorization' : token
                }
            })
                .then(response =>{console.log(response.data) ; handleSignUpFormReturnedData(response.data)} )
                .catch(error => console.log(error));


        });
        function handleSignUpFormReturnedData({header, body}) {
            let errorMessagesEl = signFormEl.closest('.signup-container').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            signFormEl.find('input[type="submit"]').attr('disabled' , false);
            switch (header) {
                case 'done':
                    signFormEl.find('input[type="submit"]').prop('disabled', true);
                    func.refreshPage();
                    setTimeout(() => location.assign("/user/signup/email"), 3000);
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

                case 'used':

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
        // end sign up




}})();