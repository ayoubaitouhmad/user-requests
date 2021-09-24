(function () {
    "use strict";
    $('document').ready(function () {
        switch ($('body').attr('page-id')) {
            // testing

            case 'testing':
                window.app.admin.test();
                break;
            // Admin
            case 'admin-dashboard-home':
                window.app.admin.all();
                break;
            case 'admin-dashboard-requests':
                window.app.admin.requests.charts();
                window.app.admin.requests.parsleyJS();
                window.app.admin.requests.datatable();
                window.app.admin.requests.page();
                window.app.admin.requests.ajaxRequest();
                window.app.admin.all();

                break;
            case 'admin-dashboard-users':
                window.app.admin.users.dataTable();
                window.app.admin.users.page();
                window.app.admin.users.charts();
                window.app.admin.users.ajaxRequest();
                window.app.admin.all();
                break;
            case 'admin-login' :
                window.app.admin.login.ajaxRequest();
                break;
            // end Admin

            // user
            // user sign up

            case  'user-signup' :
                window.app.user.signup.plugins();
                window.app.user.signup();
                break;
            case 'user-signup-email' :
                window.app.user.signup.plugins();
                window.app.user.signup.email();
                break

            case 'user-signup-profile' :
                window.app.user.signup.plugins();
                window.app.user.signup.profile();
                break;
            // end user sign up

            // user login
            case 'user-login' :
                window.app.user.signin.plugins();
                window.app.user.signin.ajax();
                break;
            // end user login

            // user dashboard
            // home
            case  'user-dashboard-home': {
                window.app.user.all();
            }
                break;
            case  'user-dashboard-setting': {
                window.app.user.all();
                window.app.user.dashboard.settings.plugins();
                window.app.user.dashboard.settings.ajaxRequest();
                window.app.user.dashboard.settings.page();
            }
                break;
            // Requests
            case 'user-dashboard-requests' :
                window.app.user.all();
                window.app.user.dashboard.requests.plugins();
                window.app.user.dashboard.requests.page();
                window.app.user.dashboard.requests.ajax();
                window.app.user.dashboard.requests.charts();
                break;

            case 'user-reset-password':
                window.app.user.security.reset();

        }
    });
})();


