(() => {
    "use strict";
    window.app.admin.requests.ajaxRequest = () => {
        // update request / answer request
        const form = $('#handle-user-request');
        const modalBtnSave = $('#modal-btn__save');
        form.on('submit', function (e) {
            e.preventDefault();
            modalBtnSave.prop('disabled', false);
            let requestId = $('#encContainer').val();
            let token = $('body').attr('page-token');
            let requestStatusEl = form.find('select');
            let requestResponseEl = form.find('textarea');


            if (form.parsley().isValid()) {
                modalBtnSave.prop('disabled', true);
                axios({
                    method: 'post',
                    url: '/admin/dashboard/requests/edit',
                    data: {
                        'action': 'post',
                        'data': {
                            'req_id': requestId,
                            'status': requestStatusEl.val(),
                            'response': requestResponseEl.val()
                        },
                    },
                    headers: {
                        'Authorization': token,
                        'Accept': 'application/json'
                    }

                })
                    .then(res => {
                        handleReturnData(res.data)
                    })
                    .catch(error => {
                        modalBtnSave.prop('disabled', false);
                    });

            }
        })

        function handleReturnData({header, body}) {
            modalBtnSave.prop('disabled', false);
            let parentEl = form.closest('.modal');
            modalBtnSave.prop('disabled', false);
            let errorMessagesEl = parentEl.find('.user-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');

            switch (header) {
                case 'done':
                    $('.modal').modal('hide');
                    func.resetScrolling();
                    func.refreshPage();
                    func.reloadPageContent('/admin/dashboard/requests');


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
                        parentEl.find('.modal-body').scroll(0, 0); // scroll into error
                    }
                    break;
                case 'cancel':

                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-warning', 'alert-danger');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));

                    parentEl.find('.modal-body').scroll(0, 0); // scroll into error
                    break;
                case 'error':

                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-danger', 'alert-warning');
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));

                    parentEl.find('.modal-body').scroll(0, 0); // scroll into error
                    break;
            }


        }

        // end  update request / answer request
    }
})();




