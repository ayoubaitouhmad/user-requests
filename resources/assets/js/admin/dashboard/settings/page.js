(() => {
    window.app.admin.dashboard.settings.page = () => {
        // variables
        const profileDataFormEl = $('#profile-data-form');
        const saveUserInfosBtnEl = $('#save-user-infos');
        const securityDataFormEl = $('#security-data-form');
        const saveUserSecurityData = $('#save-user-security-data');
        let settingsListItemEl = $('.settings-row__content .settings-items');

        // functions




        // settings list items style
        $('.settings .list-item').on('click', function () {
            let $this = $(this);
            $('.list-item').removeClass('active-link');
            $('.list-item .ico-arrow').addClass('ico-hide');
            $this.addClass('active-link');
            $this.find('.ico-arrow').removeClass('ico-hide');
        });

        // scrolling
        $('#link-profile').on('click', function () {
            let targetEl = $('#profile');
            let top = targetEl.offset().top;
            settingsListItemEl.stop().animate({
                scrollTop: top - settingsListItemEl.offset().top + settingsListItemEl.scrollTop()
            }, 1000);
        });
        $('#link-notification').on('click', function () {
            let targetEl = $('#notification');
            let top = targetEl.offset().top;

            settingsListItemEl.stop().animate({
                scrollTop: top - settingsListItemEl.offset().top + settingsListItemEl.scrollTop()
            }, 1000);


        });
        $('#link-security').on('click', function () {
            let targetEl = $('#security');
            let top = targetEl.offset().top;

            settingsListItemEl.stop().animate({
                scrollTop: top - settingsListItemEl.offset().top + settingsListItemEl.scrollTop()
            }, 1000);

        });
        $('#link-ui').on('click', function () {
            let targetEl = $('#ui');
            let top = targetEl.offset().top;

            settingsListItemEl.stop().animate({
                scrollTop: top - settingsListItemEl.offset().top + settingsListItemEl.scrollTop()
            }, 1000);

        });


        // submit form (user profile)
        saveUserInfosBtnEl.on('click', function () {
            profileDataFormEl.submit();
        });

        // submit form (user security settings)
        saveUserSecurityData.on('click', function () {
            securityDataFormEl.submit();
        });




        // show button (save new profile infos)
        $('#profile-data-form .custom-form__control').on('keyup change', function () {
            let check = true;

            let fname = $('#user-first-name');
            let lname = $('#user-last-name');
            if (
                fname.val() === '' ||
                lname.val() === ''
            ) {
                check = false;
            }
            check ?
                saveUserInfosBtnEl.addClass('active-btn') :
                saveUserInfosBtnEl.removeClass('active-btn');

        });

        // show button (save new securtiy entries)
        $('#security-data-form .custom-form__control').on('keyup', function () {
            let check = true;
            let email = $('#user-email');
            let password = $('#user-password');


            if (
                email.val() === '' ||
                password.val() === ''

            ) {
                check = false;
            }
            check ?
                saveUserSecurityData.addClass('active-btn') :
                saveUserSecurityData.removeClass('active-btn');

        });






    };
})();