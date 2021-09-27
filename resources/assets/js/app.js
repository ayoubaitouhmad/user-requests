// dependency
require('jquery');
require('bootstrap/dist/js/bootstrap');
require('feather-icons/dist/feather');

// js plugins plugins
require('axios')
require('pusher-js/dist/web/pusher.min');




// jquery plugins
require('parsleyjs/dist/parsley');
require('datatables.net/js/jquery.dataTables.min');
require('chart.js/dist/chart');




// main content
require('../../assets/js/globals');

// functions
require('../js/functions/function');





// custom js file
require('../../assets/js/globals/sb-admin');
require('../../assets/js/globals/plugins');
require('../../assets/js/globals/ajax-requests');
require('../../assets/js/globals/lazy-load');
require('../../assets/js/globals/notify');


require('./init');



// pages :



/*******************       test    *************************/
require('./testing/core');

/*******************       admin    *************************/
require('./admin/all');

// setting
require('./admin/dashboard/settings/plugins');
require('./admin/dashboard/settings/page');
require('./admin/dashboard/settings/ajax');
// users
require('./admin/dashboard/users/datatable');
require('./admin/dashboard/users/page');
require('./admin/dashboard/users/ajax-requests');
require('./admin/dashboard/users/charts');





// requests
require('./admin/dashboard/requests/chart');
require('./admin/dashboard/requests/datatable');
require('./admin/dashboard/requests/parsley');
require('./admin/dashboard/requests/page');
require('./admin/dashboard/requests/ajax-requests');

// login
require('./admin/login/ajax-requests');

/*******************       user    *************************/
// all page
require('./user/all');

// sign up
require('./user/signup/signup');
require('./user/signup/profile');
require('./user/signup/plugins');
require('./user/signin/signin');
require('./user/signin/plugins');
require('./user/signup/email');




// dashboard
// requests
require('./user/dashboard/requests/ajax-requests');
require('./user/dashboard/requests/page');
require('./user/dashboard/requests/charts');
require('./user/dashboard/requests/plugins');



// settings
require('./user/dashboard/settings/plugins');
require('./user/dashboard/settings/ajax-request');
require('./user/dashboard/settings/page');

// security
require('./user/security/security');
