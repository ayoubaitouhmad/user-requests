(() => {
    'use strict';
    window.app.user.dashboard.settings.ajaxRequest = () => {


        /*vars*/
        // forms
        const profileDataFormEl = $('#profile-data-form');
        const securityDataFormEl = $('#security-data-form');

        // btn
        const saveUserSecurityData = $('#save-user-security-data');
        const saveUserInfos = $('#save-user-infos');

        // radios
        let notifyUserFeedbackCheckboxEl = $('#notify-feedback')
        let toggleSidebarCheckboxEl = $('#toggle-sidebar')
        let hideNotificationsCheckboxEl = $('#hide-notifications')
        let notifySelfSendCheckboxEl = $('#notify-self-send')
        let notifyPasswordChangeCheckboxEl = $('#notify-password-change')
        let notifyAccountChange = $('#notify-account-change');

        let saveAvatarEl = $('#save-user-avatar')
        let token = $('body').attr('page-token');


        /*Methods*/

        // update user profile info
        profileDataFormEl.on('submit', function (e) {
            e.preventDefault();
            saveUserInfos.prop('disabled' , true);
            if (profileDataFormEl.parsley().isValid()) {
                let formData = new FormData();
                formData.append('fullname', profileDataFormEl.find('#user-first-name').val() + ' ' + profileDataFormEl.find('#user-last-name').val());
                formData.append('phone', profileDataFormEl.find('#user-phone').val());
                formData.append('address', profileDataFormEl.find('#user-address').val());
                formData.append('city', profileDataFormEl.find('#user-first-city').find(":selected").text());
                formData.append('gender', profileDataFormEl.find('#user-first-gender').val());
                formData.append('birth', profileDataFormEl.find('#user-birth').val());
                window.axios({
                    method: 'post',
                    url: '/user/dashboard/settings/edit/profile',
                    data: formData
                    ,
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'Application/Json',
                        'Authorization': token
                    }
                })
                    .then(response => {
                         handleProfileDataFormEl(response.data)

                    })
                    .catch(error => console.log(error));

            }
        });
        function handleProfileDataFormEl({title, body}) {
            saveUserInfos.prop('disabled' , false);
            let errorMessagesEl = profileDataFormEl.find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            switch (title) {
                case 'done':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-success');
                    messageTitleEl
                        .html('done , ');

                    messageBodyEl
                        .html('your infos  changed sucssesfully');
                    break;

                case 'used':
                case 'cancel' :
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-warning');
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
                case 'validation':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-info');
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
                    func.setClassAdvanced(errorMessagesEl, 'alert-danger');
                    errorMessagesEl.removeClass('d-none')
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }
        };
        // end update user profile info


        // update user avatar
        saveAvatarEl.on('click', function () {
            $(this).prop('disabled', true);
            let formData = new FormData();
            let fileEl = $('.custom-file-uploader-input');
            if (func.isFile(fileEl)) {
                formData.append('photo', fileEl.get(0).files[0]);

                window.axios({
                    method: 'post',
                    url: '/user/dashboard/settings/edit/profile/avatar',
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: formData

                })
                    .then(response => {

                        HandleSaveAvatarReturnData(response.data)
                    })
                    .catch(error => console.log(error));
            }
        });
        function HandleSaveAvatarReturnData({title, body}) {

            let errorMessagesEl = profileDataFormEl.find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            saveAvatarEl.prop('disabled', false);

            switch (title) {
                case 'done':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-success');
                    messageTitleEl
                        .html('done , ');
                    messageBodyEl
                        .html('avatar changed sucssesfully');

                    $('#user-profile-photo').attr('src', URL.createObjectURL($('.custom-file-uploader-input').get(0).files[0]));


                    break;


                case 'cancel':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-warning');

                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

                case 'validation':
                    errorMessagesEl.removeClass('d-none');
                    func.setClassAdvanced(errorMessagesEl, 'alert-danger');
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
                    func.setClassAdvanced(errorMessagesEl, 'alert-dark');
                    errorMessagesEl.removeClass('d-none')
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }
        };
        // end update user avatar


        // update user password & security
        securityDataFormEl.on('submit', function (e) {
            e.preventDefault();
            saveUserSecurityData.prop('disabled', true);
            let email = $('#user-email');
            let password = $('#user-password');
            let question = $('#user-question');
            let response = $('#user-response');

            if (securityDataFormEl.parsley().isValid()) {
                window.axios({
                    method: 'POST',
                    url: '/user/dashboard/settings/edit/profile/security',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'email': email.val(),
                            'password': password.val(),
                            'question': question.val(),
                            'response': response.val()
                        }
                    }
                })
                    .then(res => {
                        HandleAjaxSecurityReturnData(res.data)
                    })
                    .catch(error => console.log(error));
            }
        });
        function HandleAjaxSecurityReturnData({title, body}) {

            let errorMessagesEl = securityDataFormEl.find('.errors-messages');
            let messageTitleEl = errorMessagesEl.children('.modal-error-title');
            let messageBodyEl = errorMessagesEl.children('.modal-error-body');
            saveUserSecurityData.prop('disabled', false);
            switch (title) {
                case 'done':
                    errorMessagesEl.removeClass('d-none');
                    func.setClass(errorMessagesEl, 'alert-success', 'alert-warning');
                    messageTitleEl
                        .html('done , ');

                    messageBodyEl
                        .html('your security data changed sucssesfully');

                    break;


                case 'used':
                case 'cancel' :
                    errorMessagesEl.removeClass('d-none');
                  func.setClassAdvanced(errorMessagesEl, 'alert-warning');
                    errorMessagesEl.removeClass('d-none')
                    messageTitleEl
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    messageBodyEl
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;

                case 'validation':
                    errorMessagesEl.removeClass('d-none');
                  func.setClassAdvanced(errorMessagesEl, 'alert-danger');
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
                  func.setClassAdvanced(errorMessagesEl, 'alert-dark');
                    errorMessagesEl.removeClass('d-none')
                    $('.modal-error-title')
                        .html(body.substring(0, body.indexOf(',')) + ',');

                    $('.modal-error-body')
                        .html(body.substring(body.indexOf(',') + 1, body.length));
                    break;
            }
        };
        // end update user password & security


        // change notification settings security
        notifyUserFeedbackCheckboxEl.on('change' , function (e) {
            e.preventDefault();

                window.axios({
                    method: 'POST',
                    url: '/user/dashboard/settings/edit/notifications',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'prefrences_data' : notifyUserFeedbackCheckboxEl.get(0).checked,
                            'prefrences_name' : 'notifiy_when_admin_send_feedback'
                        }
                    }
                })
                    .then(res => window.location.reload())
                    .catch(error => console.log(error));

        })
        notifySelfSendCheckboxEl.on('change' , function (e) {
            e.preventDefault();

                window.axios({
                    method: 'POST',
                    url: '/user/dashboard/settings/edit/notifications',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'prefrences_data' : notifySelfSendCheckboxEl.get(0).checked,
                            'prefrences_name' : 'notifiy_when_user_send_request'

                        }
                    }
                })
                    .then(res => window.location.reload())
                    .catch(error => console.log(error));

        })
        notifyPasswordChangeCheckboxEl.on('change' , function (e) {
            e.preventDefault();

                window.axios({
                    method: 'POST',
                    url: '/user/dashboard/settings/edit/notifications',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'prefrences_data' : notifyPasswordChangeCheckboxEl.get(0).checked,
                            'prefrences_name' : 'notifiy_when_securuty_info_changed'


                        }
                    }
                })
                    .then(res => window.location.reload())
                    .catch(error => console.log(error));

        })
        notifyAccountChange.on('change' , function (e) {
            e.preventDefault();
            console.log('fdf');
            window.axios({
                method: 'POST',
                url: '/user/dashboard/settings/edit/notifications',
                headers: {
                    'Accept': 'Application/Json',
                    'Authorization': token
                },
                data: {
                    'action': 'edit',
                    'data': {
                        'prefrences_data' : notifyAccountChange.get(0).checked,
                        'prefrences_name' : 'notify_when_account_change'
                    }
                }
            })
                .then(res => {

                    window.location.reload()
                })
                .catch(error => console.log(error));

        })

        // change notification settings ui
        toggleSidebarCheckboxEl.on('change' , function (e) {
            e.preventDefault();
                window.axios({
                    method: 'POST',
                    url: '/user/dashboard/settings/edit/notifications',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'prefrences_data' : toggleSidebarCheckboxEl.get(0).checked,
                            'prefrences_name' : 'toggle_sidebar'


                        }
                    }
                })
                    .then(res => {
                        window.location.reload()
                    })
                    .catch(error => console.log(error));

        })
        hideNotificationsCheckboxEl.on('change' , function (e) {
            e.preventDefault();

                window.axios({
                    method: 'POST',
                    url: '/user/dashboard/settings/edit/notifications',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'prefrences_data' : hideNotificationsCheckboxEl.get(0).checked,
                            'prefrences_name' : 'hide_notification'
                        }
                    }
                })
                    .then(res => window.location.reload())
                    .catch(error => console.log(error));

        })





    };
})();





