(() => {
    'use strict';
    window.app.user.dashboard.settings.plugins = () => {
        const profileDataFormEl  = $('#profile-data-form')
        const securityDataFormEl  = $('#security-data-form')


        securityDataFormEl.parsley();
        profileDataFormEl.parsley();
        window.Parsley.on('field:error', function () {
            this.$element.addClass('parsley-error');
        });

        window.Parsley.on('field:error', function () {
            this.$element.removeClass('parsley-error');
        });


    };
})();