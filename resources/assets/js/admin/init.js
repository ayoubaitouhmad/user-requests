(function () {
    "use strict";
    $('document').ready(function () {


        switch ($('body').attr('page-id')) {
            case 'home':
                break;
            case 'requests':

                window.app.admin.requests.charts();
                window.app.admin.requests.parsleyJS();
                window.app.admin.requests.datatable();
                window.app.admin.requests.page();
                window.app.admin.requests.ajaxRequest();
                break;
            case 'users':
                window.app.admin.users.dataTable();
                window.app.admin.users.page();
                window.app.admin.users.charts();
                window.app.admin.users.ajaxRequest();
                break;
            case 'login' :
                window.app.admin.login.ajaxRequest();
                break
            case 'refresh' :
                break
        }
    });
})();