(()=>{
    'use strict';
    window.app.user.dashboard.ajax = () =>  {
        let newRequestFormEl = $('#new-request__form');
        // because submit button outside form we need to submit form manually
        $('#new-request__save').on('click' , function (){
            newRequestFormEl.submit();
            $(this).prop('disabled' , true);
        });

        // submit form event
        newRequestFormEl.on('submit' , function (e){
            e.preventDefault();
            let token = $('body').attr('page-token');
            let requestType=  $('#data-body__request-type');
            let requestPretext=  $('#data-body__request-pretext');
            console.log(requestPretext.val());
            console.log(requestType.val());
            window.axios({
                method : 'POST',
                url : '/user/dashboard/requests/add',
                data : {
                    'action' : 'add',
                    'data' : {
                        'pretext' : requestPretext.val(),
                        'type' : requestType.val(),
                    }
                },
                headers : {
                    'Authorization' : token
                }

            })
                .then(res => {
                    console.log(res.data);
                    handleNewRequestFormReturnData(res.data);
                })
                .catch(error=> console.log(error));

        });
        function handleNewRequestFormReturnData({header , body}){

            console.log(header);
            console.log(body);
            let parentEl = newRequestFormEl.closest('.modal-body');
            let errorMessagesEl = parentEl.find('.user-form-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
                $('#new-request__save').prop('disabled' , false);
            switch (header) {
                case 'done':
                    errorMessagesEl.addClass('d-none');
                    func.refreshPage();
                    setTimeout(() => location.assign(location.pathname), 3000);
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
    };
})();