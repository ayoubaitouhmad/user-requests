(function () {
    "use strict";
    window.app.user.signup.plugins = function () {
        let profileFormEl = $('#profile-form');
        let signupFormEl = $('#signup-form');
        let signupFormComplete = $('#signup-form-complete');
        profileFormEl.parsley();
        signupFormEl.parsley();
        signupFormComplete.parsley();


        // change field style when its validate
        window.Parsley.on('field:success', function (parsleyField) {

            $('.profile-form__header ').removeClass('active'); // remove padding to
            if($( window ).width()<= 770){
                $('.custom-file').css('margin-bottom' ,'0');
            }
        });

        // change field style when its has error
        window.Parsley.on('field:error', function (parsleyField) {
            if (profileFormEl.find(".parsley-checkImage").length > 0){
                $('.profile-form__header ').addClass('active'); // // add padding to
            }
            if($( window ).width()<= 770){
                $('.custom-file').css('margin-bottom' ,'4rem');

            }


        });


    };

})();