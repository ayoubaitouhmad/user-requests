(function (){
    "use strict";

    $('.close-admin-session').on('click' , function (){
        let token = $('body').attr('page-token');
        axios({
            method: 'post',
            url: '/admin/logout',
            data:{
                'token' : token
            }
        })
            .then(res => {

                    func.refreshPage();
                    setTimeout(() => location.assign("/admin/dashboard"), 3000);
            })
            .catch(error => console.log(error));


    });


})();