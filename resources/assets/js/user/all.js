(()=>{
    window.app.user.all = ()=>{

        let email =  $('.navbar__user-email').html();
        if(email !== undefined){
            let pusherReq = new Pusher('7dbc219cc0dd3d0e07b0', {
                cluster: 'eu'
            });
            let channelReq = pusherReq.subscribe(email);
            channelReq.bind('my-event', function(data) {
                window.location.reload();
            });
        }
        $('.user-notifications__count , .user-count').on('click' , function (){

            let countContainer = $('.user-count');
            let token = $('body').attr('page-token');
            axios({
                method : 'post',
                url : '/user/reset/notifications/count',
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