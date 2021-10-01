(() => {
    window.app.user.all = () => {
        //  TODO : check if user connected to internet
        if (window.navigator.onLine) {
            let pusherReq = new Pusher('7dbc219cc0dd3d0e07b0', {
                cluster: 'eu'
            });

            let notifyUserFeedbackCheckboxEl = $('#notify-feedback')
            let notifySelfSendCheckboxEl = $('#notify-self-send')
            let notifyPasswordChangeCheckboxEl = $('#notify-password-change')
            let notifyAccountChange = $('#notify-account-change');

            // check if user want requests notification  or not
            if (notifyUserFeedbackCheckboxEl.prop('checked')) {
                let email = $('.navbar__user-email').html();
                if (email !== undefined) {

                    let channelReq = pusherReq.subscribe(email);
                    channelReq.bind('my-event', function (data) {
                        window.location.reload();
                    });
                }

            }

            if (notifySelfSendCheckboxEl.prop('checked')) {
                let email = $('.navbar__user-email').html();
                if (email !== undefined) {

                    let channelReq = pusherReq.subscribe(email + '_new_request');
                    channelReq.bind('my-event', function (data) {
                        window.location.reload();
                    });
                }

            }

            if (notifyPasswordChangeCheckboxEl.prop('checked')) {
                let email = $('.navbar__user-email').html();
                if (email !== undefined) {

                    let channelReq = pusherReq.subscribe(email + '_change_email');
                    channelReq.bind('my-event', function (data) {
                        window.location.reload();
                    });
                }

            }

            if (notifyAccountChange.prop('checked')) {
                let email = $('.navbar__user-email').html();
                if (email !== undefined) {
                    let channelReq = pusherReq.subscribe(email + '_account_status_changed');
                    channelReq.bind('my-event', function (data) {
                        window.location.reload();
                    });
                }
            }
        }

        //  TODO : make notification satatus read
        $('.user-notifications__count , .user-count').on('click', function () {

            let countContainer = $('.user-count');
            let token = $('body').attr('page-token');
            axios({
                method: 'post',
                url: '/user/reset/notifications/count',
                headers: {
                    'Authorization': token
                }
            })
                .then(res => {
                    countContainer
                        .text('')
                        .addClass('d-none');
                })
                .catch(error => console.log(error));

        });

        //  TODO :  close user session
        $('.close-user-session').on('click', function () {
            let token = $('body').attr('page-token');
            axios({
                method: 'post',
                url: '/user/logout',
                data: {
                    'token': token
                }
            })
                .then(res => {
                    func.refreshPage();
                    setTimeout(() => location.assign("/"), 3000);
                })
                .catch(error => console.log(error));


        });

        $('[data-toggle="tooltip"]').tooltip()


    }
})();