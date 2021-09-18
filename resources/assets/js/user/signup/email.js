(function () {
    "use strict";
    window.app.user.signup.email =  () => {
        let signFormConfirmEl = $('#signup-form-complete');
        // conform email
        signFormConfirmEl.on('submit' , function (e){
            e.preventDefault();
            signFormConfirmEl.find('input[type="submit"]').attr('disabled' , true);
            let token = $('body').attr('page-token');
            axios({
                method : 'post',
                url : '/user/signup/email/confirm',
                data : {
                    'data' : {

                        'code' : signFormConfirmEl.find('.form-item__data-code').val()

                    }
                },
                headers : {
                    'Authorization' : token
                }
            })
                .then(response => {handleSignFormConfirmElReturnedData(response.data);})
                .catch(error => console.log(error));


        });
        function handleSignFormConfirmElReturnedData({header, body , data}) {
            let errorMessagesEl = signFormConfirmEl.closest('.signup-container').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            signFormConfirmEl.find('input[type="submit"]').attr('disabled' , true);


            switch (header) {
                case 'done':
                    setTimeout(() =>  func.refreshPage(), 500);
                    setTimeout(() => location.assign("/user/signup/profile"), 4000);
                    break;
                case 'cancel':
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

                case 'error':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));


                    break;
            }
        }
    };

})();