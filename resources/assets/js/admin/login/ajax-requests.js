(() => {
    window.app.admin.login.ajaxRequest = () => {
        const loginFormEl = $('#login-form');
        loginFormEl.on('submit', function (e) {
            e.preventDefault();
            let emailEl = loginFormEl.find('.form-item__data-email');
            let passwordEl = loginFormEl.find('.form-item__data-password');
            let token = $('body').attr('page-token');
            axios({
                method: 'post',
                url: '/admin/login/authorization',
                data: {
                    'action': 'post',
                    'data': {
                        'username': emailEl.val(),
                        'password': passwordEl.val()
                    }
                },
                headers: {
                    'Authorization': token
                }
            })
                .then(res => {
                    handleSubmitFormReturnedData(res.data);

                })
                .catch(error => console.log(error));
        });
        function handleSubmitFormReturnedData({header, body}) {
            let errorMessagesEl = loginFormEl.closest('.login-container').find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');

            switch (header) {
                case 'valid login':
                    func.refreshPage();
                    setTimeout(() => location.assign("/admin"), 3000);
                    break;
                case 'validation':
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

                case 'invalid login':

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

    };
})();