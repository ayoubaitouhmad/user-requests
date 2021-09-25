(() => {
    window.app.admin.dashboard.settings.ajax = () => {
        /*vars*/
        const profileDataFormEl = $('#profile-data-form');
        const securityDataFormEl = $('#security-data-form');

        const saveUserSecurityData = $('#save-user-security-data');

        let newUser = $('#new-registre')
        let newRequest = $('#new-request')


        let toggleSidebarCheckboxEl = $('#toggle-sidebar')
        let hideNotificationsCheckboxEl = $('#hide-notifications')



        let saveAvatarEl = $('#save-user-avatar')
        let token = $('body').attr('page-token');
        /*Methods*/

        // update user profile info
        // update user profile info
        profileDataFormEl.on('submit', function (e) {
            e.preventDefault();
            if (profileDataFormEl.parsley().isValid()) {
                let formData = new FormData();
                let fullname = profileDataFormEl.find('#user-first-name').val() + ' ' + profileDataFormEl.find('#user-last-name').val();
                window.axios({
                    method: 'post',
                    url: '/admin/dashboard/settings/edit/profile',
                    data: {
                        'action': 'edit',
                        'data': {
                            'fullname': fullname
                        }
                    }
                    ,
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    }
                })
                    .then(response => {
                        console.log(response.data);
                        handleProfileDataFormEl(response.data)
                    })
                    .catch(error => console.log(error));

            }
        });
        function handleProfileDataFormEl({title, body}) {
            console.log(title);
            console.log(body);
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
                        .html('your infos  changed sucssesfully.');

                    setTimeout(() => {
                        messageTitleEl
                            .html('done !! ,');

                        messageBodyEl
                            .html('to see changed this page will reload after 3s.');
                    } , 3000);

                    setTimeout(() => {
                        location.reload();
                    } , 6000);


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
                    func.setClassAdvanced(errorMessagesEl, 'alert-dark');
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
                    url: '/admin/dashboard/settings/edit/profile/avatar',
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: formData

                })
                    .then(response => {


                        console.log(response.data)
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

                    $('#admin-profile-photo').attr('src', URL.createObjectURL($('.custom-file-uploader-input').get(0).files[0]));


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

            if (securityDataFormEl.parsley().isValid()) {
                window.axios({
                    method: 'POST',
                    url: '/admin/dashboard/settings/edit/profile/security',
                    headers: {
                        'Accept': 'Application/Json',
                        'Authorization': token
                    },
                    data: {
                        'action': 'edit',
                        'data': {
                            'username': email.val(),
                            'password': password.val(),

                        }
                    }
                })
                    .then(res => {
                        console.log(res.data);
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
                    func.setClassAdvanced(errorMessagesEl, 'alert-success');
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
        newRequest.on('change' , function (e) {
            e.preventDefault();
            window.axios({
                method: 'POST',
                url: '/admin/dashboard/settings/edit/notifications',
                headers: {
                    'Accept': 'Application/Json',
                    'Authorization': token
                },
                data: {
                    'action': 'edit',
                    'data': {
                        'prefrences_data' : newRequest.get(0).checked,
                        'prefrences_name' : 'notifiy_when_new_request'
                    }
                }
            })
                .then(res => window.location.reload())
                .catch(error => console.log(error));

        })
        newUser.on('change' , function (e) {
            e.preventDefault();

            window.axios({
                method: 'POST',
                url: '/admin/dashboard/settings/edit/notifications',
                headers: {
                    'Accept': 'Application/Json',
                    'Authorization': token
                },
                data: {
                    'action': 'edit',
                    'data': {
                        'prefrences_data' : newUser.get(0).checked,
                        'prefrences_name' : 'notifiy_when_new_registre'

                    }
                }
            })
                .then(res => window.location.reload())
                .catch(error => console.log(error));

        })



        // change notification settings ui
        toggleSidebarCheckboxEl.on('change' , function (e) {
            e.preventDefault();

            window.axios({
                method: 'POST',
                url: '/admin/dashboard/settings/edit/notifications',
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
                .then(res => console.log(res.data))
                .catch(error => console.log(error));

        })
        hideNotificationsCheckboxEl.on('change' , function (e) {
            e.preventDefault();

            window.axios({
                method: 'POST',
                url: '/admin/dashboard/settings/edit/notifications',
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