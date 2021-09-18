(()=>{
    "use strict";
    window.app.admin.all = ()=>{
        console.log(window.location.pathname);
        // push notification when new  user registered
        Pusher.logToConsole = false;
        let pusher = new Pusher('7dbc219cc0dd3d0e07b0', {
            cluster: 'eu'
        });
        let channel = pusher.subscribe('add-user');
        channel.bind('my-event', function(data) {
            $('body').load(window.location.pathname);
        });
        // end receive notification when new sign up

        // set notification status to deja vue



        // push notification when new  user registered


        let newRequest = pusher.subscribe('NEW_REQUEST');
        newRequest.bind('my-event', function(data) {
            location.reload();
        });

        // end receive notification when new sign up

        // set notification status to deja vue

        $('.admin-notifications__count , .admin-count').on('click' , function (){

            let countContainer = $('.admin-count');
            let token = $('body').attr('page-token');
            axios({
                method : 'post',
                url : '/admin/reset/notifications/count',
                headers : {
                    'Authorization' : token
                }
            })
                .then(res=> {
                    countContainer
                        .text('')
                        .addClass('d-none');
                })
                .catch(error => console.log(error));
        } );

    }
})();


