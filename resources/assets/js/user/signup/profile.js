(() => {
    "use strict";
    window.app.user.signup.profile = () => {
        const inputs = $('.custom-form__control');
        let profileFormEl = $('#profile-form');

        profileFormEl[0].reset();

        inputs.on('change focus focusout keyup copy paste cut', function (event) {
            let el = $(event.target);
            if (el && el.is('input') || el.is('select') && el.val() != null) {
                let length = el.val().length;
                let move = el.siblings('.custom-control__label').children('.custom-control__label-placeholder');
                if (length > 0) {
                    move.css({
                        'transform': 'translateY(-120%)',
                        'font-size': '0.74rem'
                    });
                } else {
                    move.css({
                        'transform': 'translateY(0%)',
                        'font-size': '0.875rem'
                    });
                }
            }

        });
        inputs.on('click', function (event) {
            $(event.target).siblings('.custom-control__label').children('.custom-control__label-placeholder')
                .css({
                    'transform': 'translateY(-120%)',
                    'font-size': '0.74rem'
                });
        });


        $('.form-group__custom-control .custom-form__control').each(function (index, element) {
            let $this = $(element);
            $this
                .val($this.attr('data-user'));
            $this
                .trigger('change')
                .trigger('focusout')
                .trigger('keyup')
                .trigger('copy')
                .trigger('paste')
                .trigger('cut');

        });




        // Submit from
        profileFormEl.on('submit', function (e) {
            e.preventDefault();
            profileFormEl.find('input[type="submit"]').attr('disabled' , true);
            let token = $('body').attr('page-token');
            let data = new FormData();

            data.append('gender', $('#user-signup-gender').val());
            data.append('address', $('#user-signup-address').val());
            data.append('role', $('#user-signup-role').val());
            data.append('secretQuestion', $('#user-signup-secretQuestion').val());
            data.append('date', $('#user-signup-date').val());
            data.append('city', $('#user-signup-city').val());
            data.append('response', $('#user-signup-response').val());
            let fileEl = $('#user-signup-photo');
            let _isFile = func.isFile(fileEl);
            _isFile ? data.append('photo', fileEl[0].files[0]) :
                data.append('photo', ' ');
            if (profileFormEl.parsley().isValid()) {
                axios({
                    url: '/user/signup/profile/save',
                    method: 'post',
                    data: data,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'multipart/form-data',
                        'Authorization': token
                    }
                })
                    .then(response => {
                        console.log(response.data);
                        HandleProfileFormElReturnData(response.data)
                    })
                    .catch(error => console.log(error));
            }

        });

        function HandleProfileFormElReturnData({header, body}) {
            profileFormEl.find('input[type="submit"]').attr('disabled' , true);
            let errorMessagesEl = profileFormEl.find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (header) {
                case 'done':
                    func.refreshPage();
                    setTimeout(() => location.assign("/user/dashboard"), 3000);
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

        // end  submit form



    }
})();