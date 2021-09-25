// dependency
require('jquery');
require('bootstrap/dist/js/bootstrap');

// js plugins plugins
require('axios')
require('pusher-js/dist/web/pusher.min');




// jquery plugins
require('parsleyjs/dist/parsley');
require('datatables.net/js/jquery.dataTables');
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
require('./admin/users/datatable');
require('./admin/users/page');
require('./admin/users/ajax-requests');
require('./admin/users/charts');





// requests
require('./admin/requests/chart');
require('./admin/requests/datatable');
require('./admin/requests/parsley');
require('./admin/requests/page');
require('./admin/requests/ajax-requests');

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
