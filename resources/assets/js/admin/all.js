(()=>{
    "use strict";
    window.app.admin.all = ()=>{

        let pusher = new Pusher('7dbc219cc0dd3d0e07b0', {
            cluster: 'eu'
        });
        let newUser = $('#new-registre')
        let newRequest = $('#new-request')

        // push notification when new  user registered
        if (newUser.prop('checked')) {
            Pusher.logToConsole = false;

            let channel = pusher.subscribe('add-user');
            channel.bind('my-event', function (data) {
                $('body').load(window.location.pathname);
            });
        }
        // end receive notification when new sign up





        if (newRequest.prop('checked')) {
            // push notification when new  user registered
            let newRequestChannel = pusher.subscribe('NEW_REQUEST');
            newRequestChannel.bind('my-event', function (data) {
                location.reload();
            });
            // end receive notification when new sign up
        }

        // push notification when user chnage password
        let securityNotificationChannel = pusher.subscribe('Security_Notification');
        securityNotificationChannel.bind('my-event', function(data) {
            location.reload();
        });
        // end receive notification when new sign up

        // set notification status to deja vue

        $('.admin-notifications__count , .admin-count').on('click' , function (){
            let countContainer = $('.admin-count');
            let token = $('body').attr('page-token');
            window.axios({
                method : 'POST',
                url : '/admin/reset/notifications/count',
                headers : {
                    'Authorization' : token
                }
            })
                .then(res=>
                    countContainer
                        .text('')
                        .addClass('d-none')
                )
                .catch(error => console.log(error));
        } );








    }
})();


